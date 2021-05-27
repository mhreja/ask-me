<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\Question;
use App\Models\Answer;

use Storage;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $subjects = Subject::orderBy('subject')->get();
        return view('admin.answers.index', ['users'=>$users, 'allsubjects'=>$subjects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        return view('admin.answers.show', ['answer'=>$answer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        Storage::disk('public')->delete($answer->photo);
        $answer->delete();
        return redirect()->back()->with('error', 'Answer Deleted.');
    }


     /**
     * Mark as Approved
    */
    public function markApproved(Answer $answer)
    {
        $answer->user->increment('points', ANSWER_APPROVED_POINT);
        $data = [
            'is_approved'=>1,
        ];
        $answer->update($data);
        return redirect()->back()->with('success', "Answer(id: $answer->id) marked as Approved.");
    }

    /**
    * Mark as Correct
    */
    public function markCorrect(Answer $answer)
    {
        $answer->user->increment('points', ANSWER_CORRECT_POINT);
        $data = [
            'is_correct_marked'=>1,
        ];
        $answer->update($data);
        return redirect()->back()->with('success', "Answer(id: $answer->id) marked as Correct.");
    }


     /**
    * Mark as Rejected
    */
    public function markRejected(Request $request, Answer $answer)
    {
        $request->validate([
            'rejection_comment'=>['required', 'string', 'max:255'],
        ]);
        $request->merge(['is_approved'=>0]);
        $answer->update($request->all());
        return redirect()->back()->with('error', "Answer(id: $answer->id) Rejected.");
    }


    /**
    *Get Data to show on jquery datatable
    */

    public function getData(Request $request){
        $draw = $request->get('draw');
    
        $start = $request->get("start");
        $rowperpage = $request->get("length"); 

        $columnIndex_arr = $request->get('order');
    
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; 
        $columnName = $columnName_arr[$columnIndex]['data']; 
        $columnSortOrder = $order_arr[0]['dir']; 
        $searchValue = $search_arr['value']; 

        $recordsQuery =  Answer::query();
                    
          
        $totalRecords = $recordsQuery->count();

        //Default search field search
        if($searchValue!=""){
          $_SESSION['key'] = $searchValue;
          $recordsQuery=$recordsQuery->where(function($q) {
            $q->where('answer', 'LIKE', '%' .$_SESSION['key']. '%')
            ->orWhere('id', $_SESSION['key'])
            ->orWhere('upvotes', $_SESSION['key'])
            ->orWhere('downvotes', $_SESSION['key']);
            });
        }


        //Match from advance search form
        $searchFilter = json_decode($request->searchFilter);

        if(!empty($searchFilter->id))
        {
            $recordsQuery = $recordsQuery->where('id', $searchFilter->id);
        }

        if(!empty($searchFilter->user_id))
        {
            $recordsQuery = $recordsQuery->where('user_id', '=', $searchFilter->user_id);
        }

        if(!empty($searchFilter->is_approved))
        {
            if($searchFilter->is_approved == 1){
                $is_approvedVal = 1;
            }else $is_approvedVal = 0;
            $recordsQuery = $recordsQuery->where('is_approved', $is_approvedVal);
        }

        if(!empty($searchFilter->is_correct_marked))
        {
            if($searchFilter->is_correct_marked == 1){
                $is_correct_markedVal = 1;
            }else $is_correct_markedVal = 0;
            $recordsQuery = $recordsQuery->where('is_correct_marked', '=', $is_correct_markedVal);
        }

        if(!empty($searchFilter->rejected))
        {
            if($searchFilter->rejected == 1){
                $recordsQuery = $recordsQuery->where('rejection_comment', '!=', NULL);
            }else $recordsQuery = $recordsQuery->where('rejection_comment', '=', NULL);
        }

        if(!empty($searchFilter->from_date))
        {
          $recordsQuery = $recordsQuery->whereDate('created_at', '>=', $searchFilter->from_date)
          ->whereDate('created_at', '<=', $searchFilter->to_date);
        }

        
        //Sorting
        if ($columnName != "" && $columnSortOrder != "") {
            if ($columnName == "ID" ) {
                $columnName = 'id';
            }
            if ($columnName == "Upvotes" ) {
                $columnName = 'upvotes';
            }
            if ($columnName == "Downvotes" ) {
                $columnName = 'downvotes';
            }
            
            $recordsQuery = $recordsQuery->orderBy($columnName,$columnSortOrder);            
        }
          
        
        
        $totalRecordswithFilter = $recordsQuery->count();
        
        $records =  $recordsQuery->skip($start)
            ->take($rowperpage)
        ->get();

        $data_arr = array();
        
        foreach($records as $record){
            if($record->is_approved == 1){
                $approvedBadge = '<span class="badge badge-success">Approved</span>';
            }else $approvedBadge = '<span class="badge badge-secondary">Pending</span>';

            if($record->is_correct_marked == 1){
                $correctBadge = '<span class="badge badge-primary"><i class="fa fa-check"></i> Correct</span>';
            }else $correctBadge = '';

            if($record->rejection_comment != NULL){
                $rejectionComment = '<span class="badge badge-danger"> Rejected</span><br><span class="font-italic text-danger"><small>'.$record->rejection_comment.'</small><span>';
            }else $rejectionComment = '';

            $answeredOn = '<span class="text-info"><small>'.date('d M, Y h:i A', strtotime($record->created_at)).'</small></span>';

            $answerField = Str::limit(strip_tags($record->answer), 175).'<br>'.$approvedBadge . $correctBadge . $rejectionComment .'<br>'. $answeredOn ;

            $data_arr[] = array(
                'ID' => $record->id,
                'Answer' => $answerField,
                'Question' => '#'.$record->question->id . ': ' . Str::limit($record->question->title, 175),
                'Answered By' => $record->user->name,
                'Upvotes' => $record->upvotes,
                'Downvotes' => $record->downvotes,
                'Approved' => $record->is_approved,
                'Correct' => $record->is_correct_marked,
                'Rejection' => $record->rejection_comment,
            );        
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );
      
       echo json_encode($response);
        // echo $recordsQuery->toSql();
    }
}
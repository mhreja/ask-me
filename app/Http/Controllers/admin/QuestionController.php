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

class QuestionController extends Controller
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
        return view('admin.questions.index', ['users'=>$users, 'allsubjects'=>$subjects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return view('admin.questions.show', ['question'=>$question]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('admin.questions.edit', ['question'=>$question]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'title'=>['required', 'string', 'max:255'],
            'details'=>['required', 'string',],
        ]);

        $question->update($request->all());
        
        return redirect()->back()->with('info', 'Question Details Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        Storage::disk('public')->delete($question->photo);
        $question->delete();
        return redirect()->back()->with('error', 'Question Deleted.');
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

        $recordsQuery =  Question::query();
                    
          
        $totalRecords = $recordsQuery->count();

        //Default search field search
        if($searchValue!=""){
          $_SESSION['key'] = $searchValue;
          $recordsQuery=$recordsQuery->where(function($q) {
            $q->where('title', 'LIKE', '%' .$_SESSION['key']. '%')
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
        
        if(!empty($searchFilter->title))
        {
            $recordsQuery = $recordsQuery->where('title', 'LIKE', '%' . $searchFilter->title . '%');
        }

        if(!empty($searchFilter->subject))
        {
            $recordsQuery = $recordsQuery->where('subject_id', '=', $searchFilter->subject);
        }

        if(!empty($searchFilter->topic))
        {
            $recordsQuery = $recordsQuery->where('topic_id', '=', $searchFilter->topic);
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

        if(!empty($searchFilter->is_favorite))
        {
            if($searchFilter->is_favorite == 1){
                $is_favoriteVal = 1;
            }else $is_favoriteVal = 0;
            $recordsQuery = $recordsQuery->where('is_favorite', '=', $is_favoriteVal);
        }

        if(!empty($searchFilter->has_answer))
        {
            if($searchFilter->has_answer == 1){
                $recordsQuery = $recordsQuery->whereHas('answers');
            }else{
                $recordsQuery = $recordsQuery->doesntHave('answers');
            }
        }

        if(!empty($searchFilter->admin_answer))
        {
            if($searchFilter->admin_answer == 1){
                $admin_answerVal = 1;
            }else $admin_answerVal = 0;
            $recordsQuery = $recordsQuery->where('has_admin_answered', '=', $admin_answerVal);
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
            if ($columnName == "Title" ) {
                $columnName = 'title';
            }
            if ($columnName == "Subject" ) {
                $columnName = 'subject_id';
            }
            if ($columnName == "Topic" ) {
                $columnName = 'topic_id';
            }
            if ($columnName == "Asked" ) {
                $columnName = 'user_id';
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

            if($record->is_favorite == 1){
                $favBadge = '<span class="badge badge-primary"><i class="fa fa-heart"></i> Favorite</span>';
            }else $favBadge = '';

            if($record->has_admin_answered == 1){
                $adminAnswerBadge = '<span class="badge badge-warning"><i class="fa fa-check"></i> '.ADMIN_ANSWERED.'</span>';
            }else $adminAnswerBadge = '';

            if($record->rejection_comment != NULL){
                $rejectionComment = '<span class="badge badge-danger"> Rejected</span><br><span class="font-italic text-danger"><small>'.$record->rejection_comment.'</small><span>';
            }else $rejectionComment = '';

            $aksedOn = '<span class="text-info"><small>'.date('d M, Y h:i A', strtotime($record->created_at)).'</small></span>';

            $titleField = Str::limit($record->title, 75).'<br>'.$approvedBadge . $favBadge . $adminAnswerBadge . $rejectionComment .'<br>'. $aksedOn ;

            $data_arr[] = array(
                'ID' => $record->id,
                'Title' => $titleField,
                'Subject' => $record->subject->subject,
                'Topic' => $record->topic->topic,
                'Asked' => $record->user->name,
                'Answers' => $record->answers->count(),
                'Upvotes' => $record->upvotes,
                'Downvotes' => $record->downvotes,
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
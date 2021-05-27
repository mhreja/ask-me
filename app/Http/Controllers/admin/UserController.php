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

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
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

        $recordsQuery =  User::where('is_admin', 0);
                    
          
        $totalRecords = $recordsQuery->count();

        //Default search field search
        if($searchValue!=""){
          $_SESSION['key'] = $searchValue;
          $recordsQuery=$recordsQuery->where(function($q) {
            $q->where('name', 'LIKE', '%' .$_SESSION['key']. '%')
            ->orWhere('id', $_SESSION['key'])
            ->orWhere('email', 'LIKE', '%' .$_SESSION['key']. '%')
            ->orWhere('mobile', 'LIKE', '%' .$_SESSION['key']. '%')
            ->orWhere('username', 'LIKE', '%' .$_SESSION['key']. '%')
            ->orWhere('user_type', 'LIKE', '%' .$_SESSION['key']. '%')
            ->orWhere('interested_exam', 'LIKE', '%' .$_SESSION['key']. '%')
            ->orWhere('class', 'LIKE', '%' .$_SESSION['key']. '%')
            ->orWhere('city', 'LIKE', '%' .$_SESSION['key']. '%')
            ->orWhere('points', $_SESSION['key']);
            });
        }


        //Match from advance search form
        $searchFilter = json_decode($request->searchFilter);

        if(!empty($searchFilter->id))
        {
            $recordsQuery = $recordsQuery->where('id', $searchFilter->id);
        }

        
        //Sorting
        if ($columnName != "" && $columnSortOrder != "") {
            if ($columnName == "ID" ) {
                $columnName = 'id';
            }
            if ($columnName == "Username" ) {
                $columnName = 'username';
            }
            if ($columnName == "Points" ) {
                $columnName = 'points';
            }
            if ($columnName == "User Type" ) {
                $columnName = 'user_type';
            }
            if ($columnName == "Interested Exams" ) {
                $columnName = 'interested_exam';
            }
            if ($columnName == "Class" ) {
                $columnName = 'class';
            }
            if ($columnName == "CIty" ) {
                $columnName = 'city';
            }
            if ($columnName == "Registered On" ) {
                $columnName = 'created_at';
            }
            
            $recordsQuery = $recordsQuery->orderBy($columnName,$columnSortOrder);            
        }
          
        
        
        $totalRecordswithFilter = $recordsQuery->count();
        
        $records =  $recordsQuery->skip($start)
            ->take($rowperpage)
        ->get();

        $data_arr = array();
        
        foreach($records as $record){
            $personalDetails = 'Name: <strong>'.$record->name.'</strong><br>Email: <strong>'.$record->email.'</strong><br>Phone: <strong>'.$record->mobile.'</strong><br>DOB: <strong>'.date('d M, Y', strtotime($record->dob)).'</strong>';
            $data_arr[] = array(
                'Photo' => '<img src="'.$record->profile_photo_url.'" alt="'.$record->name.'" class="rounded-circle" width="50px">',
                'ID' => $record->id,
                'Username' => $record->username,
                'Questions' => $record->questions->count(),
                'Answers' => $record->answers->count(),
                'Points' => $record->points,
                'Personal Details' => $personalDetails,
                'User Type' => $record->user_type,
                'Interested Exams' => $record->interested_exam,
                'Class' => $record->class,
                'City' => $record->city,
                'Registered On' => date('d M, Y h:i A', strtotime($record->created_at)),
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
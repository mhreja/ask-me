@extends('admin.layouts.app')

@section('title', 'Users')

@section('head')
<style>
    .dataTables_filter input {
        border: 2px solid #d2d6dc;
    }
</style>
@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header">
            Users List
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="mydataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="no-sort">Photo</th>
                            <th>ID</th>
                            <th>Username</th>
                            <th class="no-sort">Questions</th>
                            <th class="no-sort">Answers</th>
                            <th>Points</th>
                            <th class="no-sort">Personal Details</th>
                            <th>User Type</th>
                            <th>Interested Exams</th>
                            <th>Class</th>
                            <th>City</th>
                            <th>Registered On</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="no-sort">Photo</th>
                            <th>ID</th>
                            <th>Username</th>
                            <th class="no-sort">Questions</th>
                            <th class="no-sort">Answers</th>
                            <th>Points</th>
                            <th class="no-sort">Personal Details</th>
                            <th>User Type</th>
                            <th>Interested Exams</th>
                            <th>Class</th>
                            <th>City</th>
                            <th>Registered On</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    </button>


</div>
@endsection

@section('scripts')

<!-- Get Data -->
<script type="text/javascript">
    $(document).ready(function(){
        function arrayToJson(array={}){
            var indexed_array = {};

            $.map(array, function(n, i){
                indexed_array[n['name']] = n['value'];
            });

            return indexed_array;
        }

      // DataTable
      var dataTable = $('#mydataTable').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'get',
        'ordering': true,
        "pageLength": 10,
        "lengthMenu": [[ 10, 25, 50 ,100], [ 10, 25, 50 , 100]],
        "order": [[ 1, "desc" ]],
        columnDefs: [{
            orderable: false,
            targets: "no-sort"
        }],
        'ajax': {
            'url': "{{route('users.getData')}}",
            'data': function(data){
                var searchFilter = JSON.stringify(arrayToJson($('#advaceSearchForm').serializeArray()));
                data.searchFilter = searchFilter;
            }
        },
        columns: [                
            {data: 'Photo'},
            {data: 'ID'},
            {data: 'Username'},
            {data: 'Questions'},
            {data: 'Answers'},            
            {data: 'Points'},
            {data: 'Personal Details'},
            {data: 'User Type'},
            {data: 'Interested Exams'},
            {data: 'Class'},
            {data: 'City'},
            {data: 'Registered On'},
        ],
        dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, 100, 500 ],
            [ '10 rows', '25 rows', '50 rows', '100 rows', '500 rows' ]
        ],
        buttons: [
            'pageLength', 'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        });

        $('#advaceSearchFormButton').on('click',function(e){
            e.preventDefault();
            dataTable.draw();
        });
        
    });
</script>
@endsection
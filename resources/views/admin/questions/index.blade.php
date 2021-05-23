@extends('admin.layouts.app')

@section('title', 'Questions')

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
        <h1 class="h3 mb-0 text-gray-800">Questions</h1>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample"
            aria-expanded="false" aria-controls="collapseExample" id="advBtn">
            Advance Search
        </button>
    </div>
    <div class="collapse" id="collapseExample">
        <div class="card shadow mb-4">
            <div class="card-header">
                Advance Search Form
            </div>
            <div class="card-body">
                <form id="advaceSearchForm">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">ID</label>
                                <input type="text" name="id" class="form-control" placeholder="e.g: 105">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="">Question Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Question Title">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Asked By</label>
                                <select name="user_id" class="form-control">
                                    <option disabled selected>Select</option>
                                    @forelse ($users as $item)
                                    <option value="{{$item->id}}">
                                        {{$item->name}}
                                    </option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Approved?</label>
                                <select name="is_approved" class="form-control">
                                    <option selected disabled>Select</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Favorite?</label>
                                <select name="is_favorite" class="form-control">
                                    <option selected disabled>Select</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Has Answer?</label>
                                <select name="has_answer" class="form-control">
                                    <option selected disabled>Select</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Admin Answered?</label>
                                <select name="admin_answer" class="form-control">
                                    <option selected disabled>Select</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Rejected?</label>
                                <select name="rejected" class="form-control">
                                    <option selected disabled>Select</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Subject</label>
                                <select name="subject" id="subject" class="form-control">
                                    <option disabled selected>Select a Subject</option>
                                    @forelse ($allsubjects as $item)
                                    <option value="{{$item->id}}">
                                        {{$item->subject}}
                                    </option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="">Topic</label>
                            <select name="topic" id="topic" class="form-control">
                                <option selected disabled>Select a subject first</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">From Date</label>
                                <input type="date" name="from_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="">To Date</label>
                            <input type="date" name="to_date" class="form-control">
                        </div>
                    </div>
                    <button type="submit" id="advaceSearchFormButton" class="btn btn-success">Apply Search</button>
                    <button type="reset" class="btn btn-outline-primary">Reset Form</button>
                </form>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header">
            Questions List
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="mydataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Subject</th>
                            <th>Topic</th>
                            <th>Asked</th>
                            <th class="no-sort">Answers</th>
                            <th>Upvotes</th>
                            <th>Downvotes</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Subject</th>
                            <th>Topic</th>
                            <th>Asked</th>
                            <th class="no-sort">Answers</th>
                            <th>Upvotes</th>
                            <th>Downvotes</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


</div>
@endsection

@section('scripts')

<!-- Get Topics of any subject -->
<script>
    $('#subject').on('change', function() {
        var subjectId = this.value;
        var route = "{{route('getTopics',':subid')}}";
        route = route.replace(':subid',subjectId);
        $.ajax({
        type: "GET",
        url: route,
        success: function(data){
            // console.log(data);
            var html = '';
            html += '<option selected disabled>Select a Topic</option>'
            data.forEach(function(row){
                html += '<option value="'+row.id+'">'+row.topic+'</option>';
            });
            $('#topic').html(html);
        }
        });
    });
</script>

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
        "order": [[ 0, "desc" ]],
        columnDefs: [{
            orderable: false,
            targets: "no-sort"
        }],
        'ajax': {
            'url': "{{route('questions.getData')}}",
            'data': function(data){
                var searchFilter = JSON.stringify(arrayToJson($('#advaceSearchForm').serializeArray()));
                data.searchFilter = searchFilter;
            }
        },
        columns: [                
            {data: 'ID'},
            {data: 'Title'},
            {data: 'Subject'},
            {data: 'Topic'},
            {data: 'Asked'},
            {data: 'Answers'},
            {data: 'Upvotes'},
            {data: 'Downvotes'},
            {data: null, render: function(data, type, row){
                var viewRoute = "{{route('questions.show',':id')}}";
                viewRoute = viewRoute.replace(':id', data.ID);
                
                var editRoute = "{{route('questions.edit',':id')}}";
                editRoute = editRoute.replace(':id', data.ID);

                var deleteRoute = "{{route('questions.destroy',':id')}}";
                deleteRoute = deleteRoute.replace(':id', data.ID);

                return  '<div class="dropdown">'+
                    '<button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
                    'Select Action'+
                    '</button>'+
                    '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'+
                    '<form action="'+deleteRoute+'" method="POST">'+
                        '@csrf'+
                        '@method("DELETE")'+
                        '<a class="dropdown-item" href="'+viewRoute+'" target="_blank">View</a>'+
                        '<a class="dropdown-item" href="'+editRoute+'" target="_blank">Edit</a>'+
                        '<button type="submit" class="btnDelete dropdown-item">Delete</button>'+
                    '</form>'+
                    '</div>'+
                '</div>';
            }},
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
            $('#advBtn').click();
            dataTable.draw();
        });
        
    });
</script>

<script>
    //Delete Confirmation
    $('#mydataTable').on('click', '.btnDelete', function(e){
        e.preventDefault();
        var form = $(this).parents('form');
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this question as well as the answers of this question!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                form.submit();
            } else {
                swal("The question is safe!");
            }
        });
    });
</script>
@endsection
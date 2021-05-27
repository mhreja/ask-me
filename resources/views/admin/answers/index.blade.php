@extends('admin.layouts.app')

@section('title', 'Answers')

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
        <h1 class="h3 mb-0 text-gray-800">Answers</h1>
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">ID</label>
                                <input type="text" name="id" class="form-control" placeholder="e.g: 105">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Answered By</label>
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Approved?</label>
                                <select name="is_approved" class="form-control">
                                    <option selected disabled>Select</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Is Correct Answer?</label>
                                <select name="is_correct_marked" class="form-control">
                                    <option selected disabled>Select</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Rejected?</label>
                                <select name="rejected" class="form-control">
                                    <option selected disabled>Select</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>
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
            Answers List
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="mydataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th class="no-sort">Answer</th>
                            <th class="no-sort">Question</th>
                            <th class="no-sort">Answered</th>
                            <th>Upvotes</th>
                            <th>Downvotes</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th class="no-sort">Answer</th>
                            <th class="no-sort">Question</th>
                            <th class="no-sort">Answered</th>
                            <th>Upvotes</th>
                            <th>Downvotes</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    </button>

    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="rejectModalHead"></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="rejectFormBody">
                </div>
            </div>
        </div>
    </div>


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
        "order": [[ 0, "desc" ]],
        columnDefs: [{
            orderable: false,
            targets: "no-sort"
        }],
        'ajax': {
            'url': "{{route('answers.getData')}}",
            'data': function(data){
                var searchFilter = JSON.stringify(arrayToJson($('#advaceSearchForm').serializeArray()));
                data.searchFilter = searchFilter;
            }
        },
        columns: [                
            {data: 'ID'},
            {data: 'Answer'},
            {data: 'Question'},
            {data: 'Answered By'},
            {data: 'Upvotes'},
            {data: 'Downvotes'},
            {data: null, render: function(data, type, row){
                var viewRoute = "{{route('answers.show',':id')}}";
                viewRoute = viewRoute.replace(':id', data.ID);

                var deleteRoute = "{{route('answers.destroy',':id')}}";
                deleteRoute = deleteRoute.replace(':id', data.ID);

                if(data.Approved == 0){
                    var approvingRoute = "{{route('answers.markApproved', ':id')}}";
                    approvingRoute = approvingRoute.replace(':id', data.ID);
                    var approvingLink = '<a class="dropdown-item" href="'+approvingRoute+'">Mark as Approved</a>';
                }else var approvingLink = '';

                if(data.Correct == 0){
                    var correctRoute = "{{route('answers.markCorrect', ':id')}}";
                    correctRoute = correctRoute.replace(':id', data.ID);
                    var correctLink = '<a class="dropdown-item" href="'+correctRoute+'">Mark as Correct</a>';
                }else var correctLink = '';

                if(data.Approved == 0 && data.Rejection == null){
                    var rejectLink = '<a class="dropdown-item reject-answer" href="javascript:void()" data-id="'+data.ID+'"  data-toggle="modal" data-target="#rejectModal">Reject</a>';
                }else var rejectLink = '';

                return  '<div class="dropdown">'+
                    '<button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
                    'Select Action'+
                    '</button>'+
                    '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'+
                    '<form action="'+deleteRoute+'" method="POST">'+
                        '@csrf'+
                        '@method("DELETE")'+
                        '<a class="dropdown-item" href="'+viewRoute+'" target="_blank">View</a>'+
                        approvingLink + correctLink + rejectLink +
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
            text: "Once deleted, you will not be able to recover this answers!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                form.submit();
            } else {
                swal("The answer is safe!");
            }
        });
    });

    //Reject Modal Form Create
    $('#mydataTable').on('click', '.reject-answer', function(){
        var id = $(this).data('id');
        var route = "{{route('answers.reject', ':id')}}";
        route = route.replace(':id', id);

        var modalHeadHtml = 'Reject Answer(id: '+id+')';

        var formBodyHtml = '<form action="'+route+'" method="POST" id="rejectForm">'+
            '@csrf'+
            '<div class="form-group">'+
                '<label>Reason of Rejection <span class="text-danger"> * </span></label>'+
                '<textarea class="form-control" name="rejection_comment" cols="30" rows="5" placeholder="e.g: Invalid Answer"></textarea>'+
            '</div>'+
            '<button type="button" class="btn btn-block btn-outline-secondary" data-dismiss="modal">Cancel</button>'+
            '<button class="btn btn-block btn-outline-danger" type="submit">Reject</button>'+
        '</form>';

        $('#rejectModalHead').html(modalHeadHtml);
        $('#rejectFormBody').html(formBodyHtml);
    });
</script>

@endsection
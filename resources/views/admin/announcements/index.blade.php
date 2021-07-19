@extends('admin.layouts.app')

@section('title', 'Announcement')

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
        <h1 class="h3 mb-0 text-gray-800">Announcement</h1>
        <a href="{{route('announcements.create')}}" class="btn btn-primary">
            <i class="fa fa-plus"></i> New Announcement
        </a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header">
            Announcement List
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="mydataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Details</th>
                            <th>Added On</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($announcements as $item)
                        <tr>
                            <td>{{$item->title}}</td>
                            <td class="text-center">
                                {!! $item->details !!}
                            </td>
                            <td>
                                {{date('d M, Y h:i A', strtotime($item->created_at))}}
                            </td>
                            <td>
                                <form action="{{route('announcements.destroy', $item->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?');">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Details</th>
                            <th>Added On</th>
                            <th class="no-sort">Action</th>
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
<script>
    $(document).ready(function() {
        $('#mydataTable').DataTable({
            columnDefs: [{
                orderable: false,
                targets: "no-sort"
            }],
        });
    } );
</script>
@endsection
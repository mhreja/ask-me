@extends('admin.layouts.app')

@section('title', 'Todays Corner')

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
        <h1 class="h3 mb-0 text-gray-800">Today's Corner</h1>
        <a href="{{route('todays-corner.create')}}" class="btn btn-primary">
            <i class="fa fa-plus"></i> New Today's Corner
        </a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header">
            Today's Corner List
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="mydataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th class="no-sort">Image</th>
                            <th class="no-sort">PDF</th>
                            <th>Added On</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notes as $note)
                        <tr>
                            <td>{{$note->title}}</td>
                            <td class="text-center">
                                <a target="_blank" href="{{route('todays-corner.show', $note->id)}}"
                                    class="btn btn-block btn-sm btn-info">
                                    Show Description
                                </a>
                            </td>
                            <td>
                                @if($note->image)
                                <a class="btn btn-block btn-sm btn-primary" target="_blank"
                                    href="{{asset('storage/'.$note->image)}}">
                                    Show Image
                                </a>
                                @else
                                n/a
                                @endif
                            </td>
                            <td>
                                @if($note->pdf)
                                <a class="btn btn-block btn-sm btn-danger" target="_blank"
                                    href="{{asset('storage/'.$note->pdf)}}">
                                    Open PDF
                                </a>
                                @else
                                n/a
                                @endif
                            </td>
                            <td>
                                {{date('d M, Y h:i A', strtotime($note->created_at))}}
                            </td>
                            <td>
                                <form action="{{route('todays-corner.destroy', $note->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{route('todays-corner.edit', $note->id)}}" class="btn btn-sm btn-info"
                                        target="_blank">
                                        <i class="fa fa-edit"></i>
                                    </a>
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
                            <th>Description</th>
                            <th class="no-sort">Image</th>
                            <th class="no-sort">PDF</th>
                            <th>Added On</th>
                            <th>Action</th>
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
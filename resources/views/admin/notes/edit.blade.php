@extends('admin.layouts.app')

@section('title', 'Edit Notes')

@section('head')

@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Note</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h3>Edit Note</h3>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('notes.update', $note->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 form-group">
                        <label>Title *</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            placeholder="e.g: The Title Here" value="{{$note->title}}">
                    </div>
                    <div class="col-12 form-group">
                        <label>Description *</label>
                        <textarea name="description" cols="30" rows="10"
                            class="form-control @error('description') is-invalid @enderror">{{$note->description}}</textarea>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Image: </label>
                        <input type="file" name="photo" accept="image/*">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>PDF: </label>
                        <input type="file" name="pdf_file" accept=".pdf">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-info btn-block">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<!-- CK-Editor -->
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'description' );
</script>
@endsection
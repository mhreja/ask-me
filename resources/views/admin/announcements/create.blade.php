@extends('admin.layouts.app')

@section('title', 'Create Announcement')

@section('head')

@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">New Announcement</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h3>Create Announcement</h3>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('announcements.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 form-group">
                        <label>Title *</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            placeholder="e.g: The Title Here" value="{{old('title')}}">
                        @error('title')
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-12 form-group">
                        <label>Details *</label>
                        <textarea name="details" cols="30" rows="10"
                            class="form-control @error('details') is-invalid @enderror">{{old('details')}}</textarea>
                        @error('details')
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-success btn-block">Submit</button>
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
    CKEDITOR.replace( 'details' );
</script>
@endsection
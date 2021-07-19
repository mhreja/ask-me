@extends('admin.layouts.app')

@section('title', 'Create Notes')

@section('head')

@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">New Note</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h3>Create Note</h3>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('notes.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Subject *</label>
                        <select name="subject_id" id="subject"
                            class="form-control @error('subject_id') is-invalid @enderror">
                            <option disabled selected>Select a Subject</option>
                            @forelse (\App\Models\Subject::all() as $item)
                            <option value="{{$item->id}}" {{old('subject') == $item->id ? 'selected' : ''}}>
                                {{$item->subject}}
                            </option>
                            @empty
                            @endforelse
                        </select>
                        @error('subject_id')
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="required">Topic *</label>
                        <select class="form-control @error('topic_id') is-invalid @enderror" name="topic_id" id="topic">
                            <option disabled selected>Select a Topic</option>
                        </select>
                        @error('topic_id')
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
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
                        <label>Description *</label>
                        <textarea name="description" cols="30" rows="10"
                            class="form-control @error('description') is-invalid @enderror">{{old('description')}}</textarea>
                        @error('description')
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Image: </label>
                        <input type="file" name="photo" accept="image/*">
                        @error('photo')
                        <br>
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-4 form-group">
                        <label>PDF: </label>
                        <input type="file" name="pdf_file" accept=".pdf">
                        @error('pdf_file')
                        <br>
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
    CKEDITOR.replace( 'description' );
</script>

<!-- Get Topics -->
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
@endsection
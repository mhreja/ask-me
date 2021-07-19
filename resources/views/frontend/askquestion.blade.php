@extends('frontend.layouts.app')

@section('title', 'Ask Question')

@section('head')

@endsection


@section('content')

<div class="breadcrumbs">
    <section class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Ask Question</h1>
            </div>
            <div class="col-md-12">
                <div class="crumbs">
                    <a href="{{route('home')}}">Home</a>
                    <span class="crumbs-span">/</span>
                    <span class="current">Ask Question</span>
                </div>
            </div>
        </div><!-- End row -->
    </section><!-- End container -->
</div><!-- End breadcrumbs -->

<section class="container main-content">
    <div class="row">
        <div class="col-md-9">

            <div class="page-content ask-question">
                <div class="boxedtitle page-title">
                    <h2>
                        Ask Question
                        @if(Session::has('pleasefillmore'))
                        <span style="font-size: 12px;">({{Session::get('pleasefillmore')}})</span>
                        @endif
                    </h2>
                </div>

                <div class="form-style form-style-3">
                    <form action="{{route('askquestion.store')}}" enctype="multipart/form-data" method="POST">
                        @csrf

                        <div class="form-inputs clearfix">
                            <p>
                                <label class="required">Question Title<span>*</span></label>
                                <input type="text" name="title" value="{{old('title') ?? Session::get('askquestion')}}"
                                    placeholder="Question Title">
                                @error('title')
                                <span style="color: #fe0000;">
                                    {{$message}}
                                </span>
                                @enderror

                            </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <p>
                                        <label class="required">Subject<span>*</span></label>
                                        <select name="subject_id" id="subject">
                                            <option disabled selected>Select a Subject</option>
                                            @forelse ($allsubjects as $item)
                                            <option value="{{$item->id}}"
                                                {{old('subject') == $item->id ? 'selected' : ''}}>
                                                {{$item->subject}}
                                            </option>
                                            @empty
                                            @endforelse
                                        </select>
                                        @error('subject_id')
                                        <span style="color: #fe0000;">
                                            {{$message}}
                                        </span>
                                        @enderror
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <label class="required">Topic<span>*</span></label>
                                        <select name="topic_id" id="topic">
                                            <option disabled selected>Select a Topic</option>
                                        </select>
                                        @error('topic_id')
                                        <span style="color: #fe0000;">
                                            {{$message}}
                                        </span>
                                        @enderror
                                    </p>
                                </div>
                            </div>

                            <p>
                                <div>
                                    <strong>
                                        Details
                                    </strong>
                                    <span style="color: #f00; font-size: 12px;"> *</span>
                                </div>
                                <div>
                                    <textarea name="details">{{old('details')}}</textarea>
                                    <span style="color: #f00; font-size: 12px;">
                                        @error('details')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </p>

                            <div class="row">
                                <div id="imagePreviewDiv" class="col-md-2">
                                    <img class="imagePreview" src="{{asset('img/no-image.jpg')}}" width="150px"
                                        height="150px" style="border: 1px solid #cabdbc; padding: 1px">
                                </div>
                                <div class="col-md-10">
                                    <p>
                                        <div style="margin-top:">
                                            <strong>Image</strong>
                                        </div>
                                        <div>
                                            <input type="file" id="customFile" name="image" accept="image/*">
                                            @error('image')
                                            <p>
                                                <span style="color: #f00; font-size: 12px;">
                                                    {{ $message }}
                                                </span>
                                            </p>
                                            @enderror
                                        </div>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <p class="form-submit">
                            <input type="submit" id="publish-question" value="Publish Your Question"
                                class="button color small submit">
                        </p>
                    </form>
                </div>


            </div><!-- End page-content -->
        </div><!-- End main -->
        @include('frontend.inc.rightpanel')
    </div><!-- End row -->
</section><!-- End container -->

@endsection

@section('scripts')
<!-- CK-Editor -->
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'details' );
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



<!-- Image Preview -->
<script>
    const customFile = document.getElementById("customFile");
    const previewContainer = document.getElementById("imagePreviewDiv");
    const previewImage = previewContainer.querySelector(".imagePreview");
    
    customFile.addEventListener("change", function(){
        const file = this.files[0];
 
        if(file){
            const reader = new FileReader();
 
            previewImage.style.display = "flex";
 
            reader.addEventListener("load",function(){
                //console.log(this);
                previewImage.setAttribute("src",this.result);
            });
 
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
<div class="card border-left-success shadow">
    <div class="card-body">
        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
            Add New Video &nbsp &nbsp
            @if(session()->has('success'))
            <span class="text-success py-1">
                <strong><i class="fa fa-check"></i> {{session('success')}}</strong>
            </span>
            @endif
        </div>
        <form wire:submit.prevent="submit">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" wire:model.lazy="title"
                            class="form-control @error('title') is-invalid @enderror" placeholder="Title">
                        @error('title')
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" wire:model.lazy="video_link"
                            class="form-control @error('video_link') is-invalid @enderror"
                            placeholder="e.g: https://www.youtube.com/embed/JuyB7NO0EYY">
                        @error('video_link')
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-block btn-success">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
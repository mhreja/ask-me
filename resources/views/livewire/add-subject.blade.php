<form wire:submit.prevent="submit">
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <input type="text" wire:model.lazy="subject" class="form-control @error('subject') is-invalid @enderror"
                    placeholder="Subject Name">
                @error('subject')
                <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                </span>
                @enderror

                @if(session()->has('success'))
                <span class="text-success py-1">
                    <strong><i class="fa fa-check"></i> {{session('success')}}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <button class="btn btn-block btn-success">Submit</button>
        </div>
    </div>
</form>
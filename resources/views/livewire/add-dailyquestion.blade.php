<div class="card border-left-success shadow">
    <div class="card-body">
        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
            Add New MCQ &nbsp &nbsp
            @if(session()->has('success'))
            <span class="text-success py-1">
                <strong><i class="fa fa-check"></i> {{session('success')}}</strong>
            </span>
            @endif
        </div>
        <form wire:submit.prevent="submit">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <textarea wire:model.lazy="mcq" class="form-control @error('mcq') is-invalid @enderror"
                            cols="30" rows="3" placeholder="type here....."></textarea>
                        @error('mcq')
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
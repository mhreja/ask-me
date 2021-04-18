<div class="card border-left-success shadow">
    <div class="card-body">
        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
            Add New Topic &nbsp &nbsp
            @if(session()->has('success'))
            <span class="text-success py-1">
                <strong><i class="fa fa-check"></i> {{session('success')}}</strong>
            </span>
            @endif
        </div>
        <form wire:submit.prevent="submit">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <select wire:model.change="subject" class="form-control @error('subject') is-invalid @enderror">
                            <option value="">Select</option>
                            @forelse ($subjects as $item)
                            <option value="{{$item->id}}">{{$item->subject}}</option>
                            @empty
                            @endforelse
                        </select>
                        @error('subject')
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror


                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" wire:model.lazy="topic"
                            class="form-control @error('topic') is-invalid @enderror" placeholder="Topic Name">
                        @error('topic')
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
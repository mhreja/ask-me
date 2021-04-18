<div class="form-style form-style-3">
    <form wire:submit.prevent="submit">

        @if(session()->has('success'))
        <p style="color: #fe0000;">{{session('success')}}</p>
        @endif

        <div class="form-inputs clearfix">
            <p>
                <label class="required">Question Title<span>*</span></label>
                <input type="text" id="question-title" wire:model.lazy="title" placeholder="Question Title">
                @error('title')
                <span class="form-description" style="color: #fe0000;">
                    {{$message}}
                </span>
                @enderror

            </p>
            <p>
                <label class="required">Subject<span>*</span></label>
                <span class="styled-select">
                    <select wire:model="subject">
                        <option value="">Select a Category</option>
                        @forelse ($allsubjects as $item)
                        <option value="{{$item->id}}">{{$item->subject}}
                        </option>
                        @empty
                        @endforelse
                    </select>
                </span>
                @error('subject')
                <span class="form-description" style="color: #fe0000;">
                    {{$message}}
                </span>
                @enderror
            </p>
            <p>
                <label class="required">Topic<span>*</span></label>
                <span class="styled-select">
                    <select wire:model="topic">
                        <option value="">Select a Topic</option>
                        @forelse ($filteredtopics as $item)
                        <option value="{{$item->id}}">{{$item->topic}}
                        </option>
                        @empty
                        @endforelse
                    </select>
                </span>
                @error('topic')
                <span class="form-description" style="color: #fe0000;">
                    {{$message}}
                </span>
                @enderror
            </p>

            <label>Attachment</label>
            <div class="fileinputs">
                <input type="file" class="file" wire:model="image">
                <div class="fakefile">
                    <button type="button" class="button small margin_0">Select file</button>
                    <span><i class="icon-arrow-up"></i>Browse</span>
                </div>
                @error('image')
                <span class="form-description" style="color: #fe0000;">
                    {{ $message }}
                </span>
                @enderror
            </div>

        </div>
        <div><strong>Details <span style="color: #f00;"> *</span></strong></div>
        <div wire:ignore>
            <textarea id="details"></textarea>
            <script>
                CKEDITOR.replace('details');
                CKEDITOR.instances.details.on('change', function() {
                    @this.set('details', this.getData());
                });
            </script>
            @error('details')
            <span class="form-description" style="color: #fe0000;">
                {{$message}}
            </span>
            @enderror
        </div>
        @if($details==null)
        <span>Please insert details</span>
        @endif

        <p class="form-submit">
            <input type="submit" id="publish-question" value="Publish Your Question" class="button color small submit">
        </p>
    </form>
</div>
<form class="form-style form-style-3" wire:submit.prevent="submit">
    @if(session()->has('success'))
    <p class="text-success">{{session('success')}}</p>
    @endif

    <div class="form-inputs clearfix">
        <p>
            <label class="required">Name<span>* @error('name') {{$message}} @enderror</span></label>
            <input type="text" class="required-item" wire:model.lazy="name" placeholder="John Doe">
        </p>
        <p>
            <label class="required">E-Mail<span>* @error('email') {{$message}} @enderror</span></label>
            <input type="email" class="required-item" wire:model.lazy="email" placeholder="john@example.com">
        </p>
        <p>
            <label class="required">Phone No<span>* @error('phone') {{$message}} @enderror</span></label>
            <input type="text" maxlength="10" wire:model.lazy="phone" placeholder="9765**0000">
        </p>
    </div>
    <div class="form-textarea">
        <p>
            <label for="message" class="required">Message<span>* @error('message') {{$message}} @enderror</span></label>
            <textarea id="message" class="required-item" cols="58" rows="6" wire:model.lazy="message"
                placeholder="Your message"></textarea>
        </p>
    </div>
    <p class="form-submit">
        <input name="submit" type="submit" value="Send" class="submit button small color">
    </p>
</form>
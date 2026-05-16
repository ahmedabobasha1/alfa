<form action="{{ route('website.saveConatct') }}" method="post"  class="form-horizontal">
    @csrf
    <div class="form-group row">
        <div class="col-md-6">
            <div class="form-item">
                <h4 class="form-title">{{ __('website.your_name') }} *</h4>
                <input type="text" id="name" name="name" class="form-control"
                    placeholder="{{ __('website.your_name') }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>`
        </div>
        <div class="col-md-6">
            <div class="form-item">
                <h4 class="form-title">{{ __('website.phone') }} *</h4>
                <input type="text" id="phone" name="phone" class="form-control"
                    placeholder="{{ __('website.your_phone') }}">
                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <div class="form-item">
                <h4 class="form-title">{{ __('website.email_address') }} *</h4>
                <input type="text" id="email" name="email" class="form-control"
                    placeholder="{{ __('website.your_email') }}">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

    </div>
    <div class="form-group row">
        <div class="col-md-12">
            <div class="form-item message-item">
                <h4 class="form-title">{{ __('website.your_message') }} *</h4>
                <textarea id="message" name="message" cols="30" rows="5" class="form-control address"
                    placeholder="{{ __('website.your_message') }}"></textarea>
                @error('message')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="submit-btn">
        <button id="submit" class="tl-primary-btn" type="submit">{{ __('website.send_message') }} <span
                class="icon"><i class="fa-regular fa-arrow-right"></i></span></button>
    </div>
</form>

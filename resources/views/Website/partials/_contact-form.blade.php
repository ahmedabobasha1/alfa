<form method="post" action="{{ route('website.saveConatct') }}">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group"> <span class="form-icon"><i class="fa-light fa-face-smile"></i></span>
                <input type="text" name="name" id="name" placeholder="{{ __('website.your_name') }}"
                    required="" value="{{ old('name') }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group"> <span class="form-icon"><i class="fa-light fa-envelope"></i></span>
                <input type="email" name="email" id="email" placeholder="{{ __('website.your_email') }}"
                    required="" value="{{ old('email') }}">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group"> <span class="form-icon"><i class="fa-light fa-phone"></i></span>
                <input type="text" name="phone" id="phone" placeholder="{{ __('website.your_phone') }}"
                    required="" value="{{ old('phone') }}">
                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group form-textarea"> <span class="form-icon"><i class="fa-light fa-comment"></i></span>
                <textarea name="message" id="message" cols="30" rows="3" placeholder="{{ __('website.your_message') }}"
                    required="">{{ old('message') }}</textarea>
                @error('message')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-12 text-center">
            <button class="durubtn"><span class="text-wrapper"><span
                        class="text slide-up">{{ __('website.send_message') }}</span><span
                        class="text slide-down">{{ __('website.send_message') }}</span></span></button>
        </div>
    </div>
</form>

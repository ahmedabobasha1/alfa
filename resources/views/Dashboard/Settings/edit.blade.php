<x-dashboard.layout :title="__('dashboard.edit_setting')">

    <!-- Page Header -->
    <x-dashboard.partials.page-header :header="__('dashboard.edit_setting')" :label_url="route('dashboard.home')" :label="__('dashboard.home')" />
    <!-- End Page Header -->


    <!-- Row-->
    <div class="row">
        <div class="col-sm-12 col-xl-12 col-lg-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-header">
                    <h4 class="card-title">{{ __('dashboard.edit_setting') }}</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('dashboard.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="form-group col-md-3 ">
                                <fieldset class="form-group">
                                    <label for="site_email">{{ __('dashboard.site_email') }}</label>
                                    <input type="text" class="form-control" name="site_email"
                                        value="{{ $settings['site_email'] ?? '' }}">
                                </fieldset>
                            </div>

                            <div class="form-group col-md-3 ">
                                <fieldset class="form-group">
                                    <label for="mail_from_address">{{ __('dashboard.mail_from_address') }}</label>
                                    <input type="email" class="form-control" name="mail_from_address"
                                        value="{{ $settings['mail_from_address'] ?? '' }}"
                                        placeholder="noreply@example.com">
                                    <small class="form-text text-muted">{{ __('dashboard.mail_from_address_help') }}</small>
                                </fieldset>
                            </div>

                            <div class="form-group col-md-6">
                                <fieldset class="form-group">
                                    <label for="cc_emails">{{ __('dashboard.cc_emails') }}</label>
                                    <input type="text" class="form-control" name="cc_emails"
                                        value="{{ $settings['cc_emails'] ?? '' }}"
                                        placeholder="email1@example.com, email2@example.com">
                                    <small class="form-text text-muted">{{ __('dashboard.cc_emails_help') }}</small>
                                </fieldset>
                            </div>

                            <div class="form-group col-md-4">
                                <fieldset class="form-group">
                                    <label for="site_whatspp">{{ __('dashboard.site_whatspp') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <select name="country_code" class="form-control" style="width: auto;">
                                                <option value="+20"
                                                    {{ ($settings['country_code'] ?? '') == '+20' ? 'selected' : '' }}>
                                                    🇪🇬 +20</option>
                                                <option value="+966"
                                                    {{ ($settings['country_code'] ?? '') == '+966' ? 'selected' : '' }}>
                                                    🇸🇦 +966</option>
                                                <option value="+971"
                                                    {{ ($settings['country_code'] ?? '') == '+971' ? 'selected' : '' }}>
                                                    🇦🇪 +971</option>
                                                <option value="+1"
                                                    {{ ($settings['country_code'] ?? '') == '+1' ? 'selected' : '' }}>
                                                    🇺🇸 +1</option>
                                            </select>
                                        </div>
                                        <input type="number" class="form-control" name="site_whatsapp"
                                            value="{{ $settings['site_whatsapp'] ?? '' }}">
                                    </div>
                                </fieldset>
                            </div>

                            <div class="form-group col-md-4">
                                <fieldset class="form-group">
                                    <label for="phone">{{ __('dashboard.phone') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <select name="country_code" class="form-control" style="width: auto;">
                                                <option value="+20"
                                                    {{ ($settings['country_code'] ?? '') == '+20' ? 'selected' : '' }}>
                                                    🇪🇬 +20</option>
                                                <option value="+966"
                                                    {{ ($settings['country_code'] ?? '') == '+966' ? 'selected' : '' }}>
                                                    🇸🇦 +966</option>
                                                <option value="+971"
                                                    {{ ($settings['country_code'] ?? '') == '+971' ? 'selected' : '' }}>
                                                    🇦🇪 +971</option>
                                                <option value="+1"
                                                    {{ ($settings['country_code'] ?? '') == '+1' ? 'selected' : '' }}>
                                                    🇺🇸 +1</option>
                                            </select>
                                        </div>
                                        <input type="number" class="form-control" name="phone"
                                            value="{{ $settings['phone'] ?? '' }}">
                                    </div>
                                </fieldset>
                            </div>

                            <div class="form-group col-md-3 ">
                                <fieldset class="form-group">
                                    <label for="site_twitter"> {{ __('dashboard.site_twitter') }}</label>
                                    <input type="text" class="form-control" name="site_twitter"
                                        value="{{ $settings['site_twitter'] }}">
                                </fieldset>
                            </div>

                         
                            <div class="form-group col-md-3 ">
                                <fieldset class="form-group">
                                    <label for="site_facebook">{{ __('dashboard.site_facebook') }}</label>
                                    <input type="text" class="form-control" name="site_facebook"
                                        value="{{ $settings['site_facebook'] }}">
                                </fieldset>
                            </div>

                            <div class="form-group col-md-3 ">
                                <fieldset class="form-group">
                                    <label for="site_instagram">{{ __('dashboard.site_instagram') }}</label>
                                    <input type="text" class="form-control" name="site_instagram"
                                        value="{{ $settings['site_instagram'] }}">
                                </fieldset>
                            </div>

                            <div class="form-group col-md-3 ">
                                <fieldset class="form-group">
                                    <label for="site_linkedin">{{ __('dashboard.site_linkedin') }}</label>
                                    <input type="text" class="form-control" name="site_linkedin"
                                        value="{{ $settings['site_linkedin'] }}">
                                </fieldset>
                            </div>

                            <div class="form-group col-md-3 ">
                                <fieldset class="form-group">
                                    <label for="site_youtube">{{ __('dashboard.site_youtube') }}</label>
                                    <input type="text" class="form-control" name="site_youtube"
                                        value="{{ $settings['site_youtube'] }}">
                                </fieldset>
                            </div>

                            <div class="form-group col-md-3 ">
                                <fieldset class="form-group">
                                    <label for="site_snapchat">{{ __('dashboard.site_snapchat') }}</label>
                                    <input type="text" class="form-control" name="site_snapchat"
                                        value="{{ $settings['site_snapchat'] }}">
                                </fieldset>
                            </div>

                            <div class="form-group col-md-3 ">
                                <fieldset class="form-group">
                                    <label for="site_tiktok">{{ __('dashboard.site_tiktok') }}</label>
                                    <input type="text" class="form-control" name="site_tiktok"
                                        value="{{ $settings['site_tiktok'] }}">
                                </fieldset>
                            </div>


                            <div class="form-group col-md-3 ">
                                <fieldset class="form-group">
                                    <label for="site_pinterest">{{ __('dashboard.site_pinterest') }}</label>
                                    <input type="text" class="form-control" name="site_pinterest"
                                        value="{{ $settings['site_pinterest'] }}">
                                </fieldset>
                            </div>


                            <div class="form-group col-md-3 ">
                                <fieldset class="form-group">
                                    <label for="site_telegram">{{ __('dashboard.site_telegram') }}</label>
                                    <input type="text" class="form-control" name="site_telegram"
                                        value="{{ $settings['site_telegram'] }}">
                                </fieldset>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="">{{ __('dashboard.site_map') }}</label>
                                <textarea class="form-control" rows="3" name="site_map" type="text">{{ $settings['site_map'] }}</textarea>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.google_analytics_id') }}</label>
                                <input type="text" class="form-control" name="google_analytics_id"
                                    value="{{ $settings['google_analytics_id'] ?? '' }}" placeholder="G-XXXXXXXXXX">
                                <small
                                    class="form-text text-muted">{{ __('dashboard.google_analytics_id_help') }}</small>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="">{{ __('dashboard.google_tag_manager_id') }}</label>
                                <input type="text" class="form-control" name="google_tag_manager_id"
                                    value="{{ $settings['google_tag_manager_id'] ?? '' }}"
                                    placeholder="GTM-PZSPLT25">
                                <small
                                    class="form-text text-muted">{{ __('dashboard.google_tag_manager_id_help') }}</small>
                            </div>

                            <div class="form-group col-md-12 mt-3">
                                <iframe src="{{ $settings['site_map'] }}" width="100%" height="250"
                                    style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>

                          
                            <div class="form-group col-md-12 mt-3">
                                <button type="submit" class="btn btn-success"><i class="icon-note"></i>
                                    {{ __('dashboard.update') }} </button>
                                <a href="{{ route('dashboard.settings.show') }}"><button type="button"
                                        class="btn btn-danger mr-1"><i class="icon-trash"></i>
                                        {{ __('dashboard.cancel') }}</button></a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->




</x-dashboard.layout>

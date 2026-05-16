<div class="header-top">
    <div class="auto-container">
        <div class="inner-container">
            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div class="header-top_text py-2">{{ $main_address->address }}</div>

                <div class="right-box d-flex align-items-center flex-wrap">
                    <!-- Info List -->
                    <ul class="header-top_list">
                        <li>
                            <span class="icon"><img src="{{Path::imagesPath('icons/phone.png')}}" alt="" /></span>
                            <a href="tel:{{$fullPhone}}"> {{$phone}}</a>
                        </li>
                    </ul>
                    <!-- Social Box -->
                    <div class="header_socials">
                        <span>Follow Us :</span>
                        @if(config('settings.site_facebook'))
                            <a href="{{config('settings.site_facebook')}}" target='_'><i class="fa-brands fa-facebook-f"></i></a>
                        @endif
                        @if(config('settings.site_twitter'))
                           <a href="{{config('settings.site_twitter')}}" target='_'><i class="fa-brands fa-twitter fa-fw"></i></a>
                        @endif
                        @if(config('settings.site_youtube'))
                            <a href="{{config('settings.site_youtube')}}" target='_'><i class="fa-brands fa-youtube"></i></a>
                        @endif
                        @if(config('settings.site_instagram'))
                          <a href="{{config('settings.site_instagram')}}" target='_'><i class="fa-brands fa-instagram"></i></a>
                        @endif
                     
                    
                      
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
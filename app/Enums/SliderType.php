<?php

namespace App\Enums;

enum SliderType: string
{
    case HOME = 'home';
    case OFFER = 'offer';
    case TOP_HEADER = 'top_header';
    case MOBILE_BANNER = 'mobile_banner';
    case NEWSLETTER_MODAL = 'newsletter_modal';
}

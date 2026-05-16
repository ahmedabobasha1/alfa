<?php

namespace App\Enums;

enum AlbumType: string
{
    case GALLERY = 'gallery';
    case BEFORE_AFTER = 'before_after';
    case MEDIA = 'media';
}

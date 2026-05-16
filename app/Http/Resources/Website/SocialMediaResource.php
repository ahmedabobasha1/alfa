<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SocialMediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'facebook' => config('settings.site_facebook'),
            'twitter' => config('settings.site_twitter'),
            'linkedin' => config('settings.site_linkedin'),
            'instagram' => config('settings.site_instagram'),
            'youtube' => config('settings.site_youtube'),
            'tiktok' => config('settings.site_tiktok'),
            'pinterest' => config('settings.site_pinterest'),
            'snapchat' => config('settings.site_snapchat'),
            'whatsapp' => config('settings.site_whatsapp'),
        ];
    }
}

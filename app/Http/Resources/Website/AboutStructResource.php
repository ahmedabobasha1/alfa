<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutStructResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->{'title_'.app()->getLocale()},
            'text' => $this->{'text_'.app()->getLocale()},
            'icon' => $this->icon_path,
            'alt_icon' => $this->alt_icon,
            'order' => $this->order,
        ];
    }
}

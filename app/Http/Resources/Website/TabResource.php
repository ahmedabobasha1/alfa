<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TabResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->{'name_'.app()->getLocale()},
            'short_desc' => $this->{'short_desc_'.app()->getLocale()},
            'long_desc' => $this->{'long_desc_'.app()->getLocale()},
            'icon' => $this->icon_path,
            'alt_icon' => $this->alt_icon,
            'status' => $this->status,
            'order' => $this->order,
        ];
    }
}

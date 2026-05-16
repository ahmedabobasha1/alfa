<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PartnerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->{'name_'.app()->getLocale()},
            'logo' => $this->logo_path,
            'alt_logo' => $this->alt_logo,
            'description' => $this->{'description_'.app()->getLocale()},
        ];
    }
}

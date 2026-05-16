<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'description' => $this->{'description_'.app()->getLocale()},
            'logo' => $this->logo_path,

        ];
    }
}

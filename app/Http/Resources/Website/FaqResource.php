<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FaqResource extends JsonResource
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
            'question' => $this->{'question_'.app()->getLocale()},
            'answer' => $this->{'answer_'.app()->getLocale()},
            'order' => $this->order,
            'status' => $this->status,
        ];
    }
}

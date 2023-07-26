<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\QuestionResource;


class FormDetailResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'limit_one_response' => $this->limit_one_response,
            'creator_id' => $this->creator_id,
            'allowed_domains' => json_decode($this->allowed_domains),
            'questions' => QuestionResource::collection($this->questions), //TODO: relations to questions           
        ];
    }
}

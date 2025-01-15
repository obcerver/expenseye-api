<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
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
            'description' => $this->description,
            'value' => $this->value,
            'issuedAt' => $this->value,
            'user' => $this->user,
            'category' => $this->category,
            'createdAt' => $this->created_at,
        ];
    }
}

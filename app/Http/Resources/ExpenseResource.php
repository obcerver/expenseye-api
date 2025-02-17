<?php

namespace App\Http\Resources;

use App\Models\Category;
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
            'issuedAt' => $this->issuedAt,
            'user' => $this->user,
            'categoryName' => $this->getCategoryName($this->category),
            'category' => $this->category,
            'createdAt' => $this->created_at,
        ];
    }

    protected function getCategoryName($categoryId)
    {
        // If category ID is null, return null
        if (!$categoryId) {
            return null;
        }

        // Find the category by ID
        $category = Category::find($categoryId);

        // Return the category name or null if not found
        return $category ? $category->name : null;
    }
}

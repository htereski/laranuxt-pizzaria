<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PizzaOrderResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $items = [];

        foreach ($this->resource as $item) {
            $items[] = [
                'id' => $item->id,
                'value' => $item->value,
                'pizza' => [
                    'id' => $item->pizza->id,
                    'name' => $item->pizza->name,
                ],
                'size' => [
                    'id' => $item->size->id,
                    'name' => $item->size->name
                ],
                'user' => [
                    'id' => $item->user->id,
                    'name' => $item->user->name,
                ]
            ];
        }

        return [
            'data' => $items,
            'pagination' => [
                'total' => $this->total(),
                'count' => $this->count(),
                'per_page' => $this->perPage(),
                'current_page' => $this->currentPage(),
                'total_pages' => $this->lastPage(),
                'links' => [
                    'next' => $this->nextPageUrl(),
                    'previous' => $this->previousPageUrl(),
                ],
            ],
        ];
    }
}

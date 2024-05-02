<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PizzaOrderCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $items = [];

        $i = 0;
        foreach ($this->resource as $item) {
            $items += [
                $i => [
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
                ]
            ];
            $i++;
        }

        return $items;
    }
}

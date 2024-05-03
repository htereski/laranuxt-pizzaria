<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResourceCollection extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $items = [];

        $i = 0;
        foreach ($this->resource as $item) {
            $items += [
                $i => [
                    'id' => $item->id,
                    'name' => $item->name,
                    'email' => $item->email
                ]
            ];
            $i++;
        }

        return $items;
    }
}

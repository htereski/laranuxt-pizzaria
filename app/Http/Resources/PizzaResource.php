<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PizzaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'pizza' => [
                'id' => $this->id,
                'name' => $this->name,
            ],
            'kind' => [
                'id' => $this->kind->id,
                'name' => $this->kind->name
            ]
        ];
    }
}

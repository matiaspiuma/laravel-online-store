<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

final class RangeResource extends JsonResource
{
    public function toArray($request) : array
    {
        return [
            'id' => $this->id,
            'type' => 'range',
            'attributes' => [
                'name' => $this->name,
                'description' => $this->description,
                'is_active' => $this->is_active,
            ],
            'relationships' => [
                'products' => ProductResource::collection(
                    $this->whenLoaded(
                        'products',
                    )
                ),
            ],
        ];
    }
}

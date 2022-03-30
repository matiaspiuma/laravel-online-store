<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

final class VariantResource extends JsonResource
{
    public function toArray($request) : array
    {
        return [
            'id' => $this->id,
            'type' => 'variant',
            'attributes' => [
                'name' => $this->name,
                'cost' => $this->cost,
                'retail' => $this->retail,
                'height' => $this->height,
                'width' => $this->width,
                'length' => $this->length,
                'weight' => $this->weight,
                'is_active' => $this->is_active,
                'shippable' => $this->shippable,
            ],
            'relationships' => [
                'product' => new ProductResource(
                    $this->whenLoaded('product')
                ),
            ],
        ];
    }
}

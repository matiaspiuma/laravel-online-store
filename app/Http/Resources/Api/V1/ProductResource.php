<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

final class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'type' => 'product',
            'attributes' => [
                'name' => $this->name,
                'description' => $this->description,
                'price' => [
                    'cost' => $this->cost,
                    'retail' => $this->retail,
                ],
                'vat' => $this->vat,
                'height' => $this->height,
                'width' => $this->width,
                'length' => $this->length,
                'weight' => $this->weight,
                'is_active' => $this->is_active,
                'shippable' => $this->shippable,
            ],
            'relationships' => [
                'variants' => VariantResource::collection(
                    $this->whenLoaded(
                        'variants',
                    )
                ),
                'category' => new CategoryResource($this->whenLoaded('category')),
                'range' => new RangeResource($this->whenLoaded('range')),
            ],
            'links' => [
                '_self' => route('api:v1:products:show', $this->id),
                '_parent' => route('api:v1:products:index'),
            ]
        ];
    }
}

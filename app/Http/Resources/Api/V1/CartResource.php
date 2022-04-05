<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

final class CartResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->uuid,
            'type' => 'cart',
            'attributes' => [
                'status' => $this->status,
                'coupon' => [
                    'coode' => $this->coupon,
                    'reduction' => $this->reduction,
                ],
                'total' => $this->total,
            ],
            'relationships' => [
                'items' => CartItemResource::collection(
                    $this->whenLoaded('items')
                ),
            ]
        ];
    }
}

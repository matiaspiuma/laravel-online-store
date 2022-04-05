<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Carts\Products;

use App\Http\Requests\Api\V1\Carts\ProductRequest;
use App\Http\Resources\Api\V1\CartItemResource;
use Domains\Customer\Actions\AddProductToCart;
use Domains\Customer\Factories\CartItemFactory;
use Domains\Customer\Models\Cart;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

final class StoreController
{
    public function __invoke(ProductRequest $request, Cart $cart): JsonResponse
    {
        $cartItem = AddProductToCart::handle(
            cartItem: CartItemFactory::make(
                $request->validated()
            ),
            cart: $cart
        );

        return new JsonResponse(
            data: new CartItemResource(
                resource: $cartItem
            ),
            status: JsonResponse::HTTP_CREATED
        );
    }
}

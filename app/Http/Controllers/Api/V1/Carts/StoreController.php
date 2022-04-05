<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Carts;

use App\Http\Resources\Api\V1\CartResource;
use Domains\Customer\Actions\CreateCartAction;
use Domains\Customer\Factories\CartFactory;
use Domains\Customer\States\Statuses\CartStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JustSteveKing\StatusCode\Http;

final class StoreController
{
    public function __invoke(Request $request)
    {
        $cart = CreateCartAction::handle(
            cart: CartFactory::make(
                attributes: [
                    'status' => CartStatus::Pending->value,
                    'user_id' => auth()->id() ?? null,
                ]
            )
        );

        return new JsonResponse(
            data: new CartResource(
                resource: $cart
            ),
            status: Http::CREATED
        );
    }
}

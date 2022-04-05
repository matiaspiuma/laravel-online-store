<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Carts;

use App\Http\Resources\Api\V1\CartResource;
use Illuminate\Http\Request;
use JustSteveKing\StatusCode\Http;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class IndexController
{
    public function __invoke(Request $request): Response
    {
        if (! auth()->check() || ! auth()->user()->cart()->count()) {
            return new Response(
                content: null,
                status: Http::NO_CONTENT
            );
        }

        return new JsonResponse(
            data: new CartResource(
                resource: auth()->user()->cart
            ),
            status: Http::OK
        );
    }
}

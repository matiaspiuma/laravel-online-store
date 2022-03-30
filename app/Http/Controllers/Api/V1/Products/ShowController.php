<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Products;

use App\Http\Resources\Api\V1\ProductResource;
use Domains\Catalog\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JustSteveKing\StatusCode\Http;
use Spatie\QueryBuilder\QueryBuilder;

final class ShowController
{
    public function __invoke(Request $request, string $id): JsonResponse
    {
        $product = QueryBuilder::for(
            Product::class
        )
            ->allowedIncludes(
                ['variants', 'category', 'range']
            )
            ->findOrFail($id);

        return response()->json(
            new ProductResource(
                $product
            ),
            Http::OK
        );
    }
}

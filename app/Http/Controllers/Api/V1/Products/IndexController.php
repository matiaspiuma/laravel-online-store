<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Products;

use App\Http\Resources\Api\V1\ProductResource;
use Domains\Catalog\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JustSteveKing\StatusCode\Http;
use Spatie\QueryBuilder\QueryBuilder;

final class IndexController
{
    public function __invoke(Request $request): JsonResponse
    {
        $products = QueryBuilder::for(
            Product::class
        )
            ->allowedFilters([
                'name',
                'price',
                'is_active',
                'vat',
            ])
            ->allowedSorts([
                'name',
                'cost',
            ])
            ->allowedIncludes([
                'variants',
                'category',
                'range',
            ])
            ->paginate(
                $request->input('per_page', 10)
            );

        return response()->json(
            ProductResource::collection($products),
            Http::OK
        );
    }
}

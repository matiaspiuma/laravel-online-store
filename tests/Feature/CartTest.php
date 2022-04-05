<?php

declare(strict_types=1);

use Domains\Catalog\Models\Variant;
use Domains\Customer\Models\Cart;
use Domains\Customer\Models\User;
use Domains\Customer\States\Statuses\CartStatus;
use Illuminate\Testing\Fluent\AssertableJson;
use JustSteveKing\StatusCode\Http;

use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('creates a cart for an unauthenticated user', function () {
    post(
        route('api:v1:carts:store')
    )->assertStatus(
        Http::CREATED
    )->assertJson(
        fn (AssertableJson $json) =>
        $json
            ->where('type', 'cart')
            ->where('attributes.status', CartStatus::Pending->value)
            ->etc()
    );
});

it('returns a cart for a logged in user', function () {
    $cart = Cart::factory()->create();

    auth()->loginUsingId($cart->user_id);

    get(
        route('api:v1:carts:index')
    )->assertStatus(
        Http::OK
    );
});

it('returns a not found status when a guest tries to retrieve their carts', function () {
    get(
        route('api:v1:carts:index')
    )->assertStatus(
        Http::NO_CONTENT
    );
});

it('can add a new product to a cart', function () {
    $cart = Cart::factory()->create();
    $variant = Variant::factory()->create();

    post(
        route('api:v1:carts:products:store', $cart->uuid),
        [
            'quantity' => 1,
            'purchasable_id' => $variant->id,
            'purchasable_type' => 'variant',
        ]
    )->assertStatus(
        Http::CREATED
    )->assertJson(
        fn (AssertableJson $json) =>
        $json
            ->where('type', 'cart-item')
            ->where('attributes.quantity', 1)
            ->where('attributes.item.id', $variant->id)
            ->etc()
    );
});

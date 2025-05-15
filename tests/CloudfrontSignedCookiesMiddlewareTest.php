<?php

use Creacoon\LaravelCloudfrontCookies\Http\Middleware\CloudfrontSignedCookiesMiddleware;

use function Pest\Laravel\call;
use function Pest\Laravel\get;

it('skip generation if signed cookies already present', function () {
    $cookies = CloudfrontSignedCookiesMiddleware::cookieNames();

    $response = call(
        method: 'GET',
        uri: '/',
        cookies: collect($cookies)
            ->mapWithKeys(fn (string $c) => [
                $c => fake()->word(),
            ])
            ->toArray(),
    );

    foreach ($cookies as $cookie) {
        $response->assertCookieMissing($cookie);
    }
});

it('generates signed cookies', function () {
    $cookies = CloudfrontSignedCookiesMiddleware::cookieNames();

    $response = get('/');

    foreach ($cookies as $cookie) {
        $response->assertCookie($cookie);
    }
});

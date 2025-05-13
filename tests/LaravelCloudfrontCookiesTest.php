<?php

use Creacoon\LaravelCloudfrontCookies\Facades\LaravelCloudfrontCookies;

it('generates signed cookies', function () {
    $cookies = LaravelCloudfrontCookies::resource('http*://localhost/*')
        ->expiresAt(now()->addDay())
        ->policy()
        ->get();

    expect($cookies)->toHaveKeys(['CloudFront-Policy', 'CloudFront-Key-Pair-Id', 'CloudFront-Signature']);
});

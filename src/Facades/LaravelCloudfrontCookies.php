<?php

declare(strict_types=1);

namespace Creacoon\LaravelCloudfrontCookies\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Creacoon\LaravelCloudfrontCookies\LaravelCloudfrontCookies
 *
 * @method static \Creacoon\LaravelCloudfrontCookies\LaravelCloudfrontCookies resource(string $domain)
 * @method static \Creacoon\LaravelCloudfrontCookies\LaravelCloudfrontCookies expiresAt(\Illuminate\Support\Carbon $expires_at)
 * @method static \Creacoon\LaravelCloudfrontCookies\LaravelCloudfrontCookies policy(?string $policy = null)
 * @method static array get()
 */
class LaravelCloudfrontCookies extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Creacoon\LaravelCloudfrontCookies\LaravelCloudfrontCookies::class;
    }
}

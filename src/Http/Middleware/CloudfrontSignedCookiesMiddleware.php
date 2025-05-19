<?php

declare(strict_types=1);

namespace Creacoon\LaravelCloudfrontCookies\Http\Middleware;

use Carbon\CarbonInterval;
use Closure;
use Creacoon\LaravelCloudfrontCookies\Facades\LaravelCloudfrontCookies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CloudfrontSignedCookiesMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $cookies = collect(static::cookieNames());

        $shouldNotSign = config('cloudfront-cookies.resource') === '' ||
            config('cloudfront-cookies.key_pair_id') === '' ||
            config('cloudfront-cookies.private_key_path') === '' ||
            $cookies->every(function ($cookie) use ($request) {
            return $request->hasCookie($cookie);
        });

        if ($shouldNotSign) {
            return $next($request);
        }

        $resource = config('cloudfront-cookies.resource');

        $intervalValue = config('cloudfront-cookies.cookies_expiration.value');
        $intervalUnit = config('cloudfront-cookies.cookies_expiration.unit');

        $interval = CarbonInterval::fromString($intervalValue.$intervalUnit);

        $expiration = now()->add($interval);

        $cookies = LaravelCloudfrontCookies::resource($resource)
            ->expiresAt($expiration)
            ->policy()
            ->get();

        $host = config('cloudfront-cookies-cookies.cookie_domain');

        collect($cookies)->each(function (string $value, string $name) use ($host, $interval) {
            $cookie = Cookie::make($name, $value, minutes: (int) $interval->totalMinutes, domain: $host);

            Cookie::queue($cookie);
        });

        return $next($request);
    }

    public static function cookieNames(): array
    {
        return [
            'CloudFront-Policy',
            'CloudFront-Key-Pair-Id',
            'CloudFront-Signature',
        ];
    }
}

<?php

declare(strict_types=1);

namespace Creacoon\LaravelCloudfrontCookies;

use Aws\CloudFront\CloudFrontClient;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelCloudfrontCookiesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-cloudfront-cookies')
            ->hasConfigFile('cloudfront-cookies');
    }

    public function packageBooted(): void
    {
        $this->app->singleton(CloudFrontClient::class, function () {
            return new CloudFrontClient([
                'version' => config('cloudfront-cookies.version'),
                'region' => config('cloudfront-cookies.region'),
            ]);
        });
    }
}

<?php

declare(strict_types=1);

namespace Creacoon\LaravelCloudfrontCookies;

use Aws\CloudFront\CloudFrontClient;
use Exception;
use Illuminate\Support\Carbon;

class LaravelCloudfrontCookies
{
    public string $resource;

    public Carbon $expires_at;

    public string $policy;

    public function __construct(public readonly CloudFrontClient $client) {}

    public function resource(string $resource): static
    {
        $this->resource = $resource;

        return $this;
    }

    public function expiresAt(Carbon $expires_at): static
    {
        $this->expires_at = $expires_at;

        return $this;
    }

    public function policy(?string $policy = null): static
    {
        if (! isset($this->resource, $this->expires_at)) {
            throw new Exception('resource and expires_at must be set before calling policy()');
        }

        $this->policy = $policy ?? <<<JSON
            {
                "Statement": [
                    {
                        "Resource": "$this->resource",
                        "Condition": {
                            "DateLessThan": {
                              "AWS:EpochTime": {$this->expires_at->timestamp}
                            }
                        }
                    }
                ]
            }
JSON;

        return $this;
    }

    public function get(): array
    {
        return $this->client->getSignedCookie([
            'policy' => $this->policy,
            'private_key' => config('cloudfront-cookies.private_key_path'),
            'key_pair_id' => config('cloudfront-cookies.key_pair_id'),
        ]);
    }
}

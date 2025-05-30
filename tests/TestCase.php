<?php

namespace Creacoon\LaravelCloudfrontCookies\Tests;

use Creacoon\LaravelCloudfrontCookies\Http\Middleware\CloudfrontSignedCookiesMiddleware;
use Creacoon\LaravelCloudfrontCookies\LaravelCloudfrontCookiesServiceProvider;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected $loadEnvironmentVariables = true;

    protected function setUp(): void
    {
        parent::setUp();

        Route::middleware([CloudfrontSignedCookiesMiddleware::class, AddQueuedCookiesToResponse::class])
            ->get('/', function () {
                return 'ok';
            });
    }

    protected function getPackageProviders($app): array
    {
        return [
            LaravelCloudfrontCookiesServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        Storage::disk('local')->put('tests/test_private_key.pem', '-----BEGIN PRIVATE KEY-----
MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCZBUqdtCv8luW1
iV3JXPq9IDjKlLvsmnYU7RgZlNfkJpqdM21gDgD2VFM9PQvmSuSsBqLS9E18zs4N
BrQyfXRqGocbhma4W1ZfnX47rELXYMncJTjdc0z6OE+zok7/wpBXZ+IA75t4rGq/
wCQbKOnz5XQ2QvNzmZEs9WBg7fYWJGrIseJN7/lytMYhdE1HCwwdF2k67ul07rlf
s16IyT99c4OmgzkzhP99UQItmhoHU0fgPmhQ0n01M7O/auE1OM5UHGuMi6559tX6
UNv8V8R2h/vsqlZS6k7fkNjTlft9Gn3c6MavpK5SV3hhZz+S2BQ22AGIUPmBeFbk
jc49Sr2fAgMBAAECggEABNKqrDD/+FFPoo3wOGbt02tiK6bOC+ilmbmlumiukhce
/tI4IebosNrhJMHGNj2Pp4kuAjTtz3+h9VcljTg9cXquKqsgLn9Y4ZQ2yyEXmjvU
VCDFAg9reORKRTPzn989NwQKY4bDZ7JHfkB+fG/cFj8NKQipk6/4NQQm3YDVvyzd
YYf4cikghy70xurRIBoy2kjkuqYRwKZsPUJ1FWZ22mHDiKJt9F7gfhZEIeK2XZ3X
sIOp5215404k/KecPcXw+fs0TGB4yP0q+/HFNXYa9PJe2CPk+DT9Z3dTnY1DrI0x
KtCVokaSgnYtq35mitLYk5eRQHbtQrWlH9qwo7+HQQKBgQDNIX4Kzt5xtPmE05cn
ei8+M/qPNYItu006szJBXdQAviFMLt2CzIr+v17F6K4ehk84ZmZaw5Ej/Hz/AvgA
N6kA+cPALPtizV045zSQCpbCsSqYQKh4c0hIdMrc/dkiOqOSIWqKKn/BomqowZrv
ugcxuxeC3mcI5OM9IKCo67pXawKBgQC+96RtV5xmllWiI0fTWAwFRj58YhQk+wv3
+Jz7Rt/lm40rq0IlAHQlNUah+eks1sDGgidFFo2HhqPU6ORkMKZdU0jSF8jD29mR
PMIgnN6ATVSXUHOmb/KhhvChzIHNiI3PLUvQSus45yoRcxLZ6E8spC+7vCKJsQsb
dp0r246jnQKBgQCCMHGIdobjb9K1JH1YhsmZFvA9F97JG4kGaljI973nwsPrUAsy
SpMk31xNC0IHCYMZ7pOjo19okYTbbIztxmWywtIkE+hwappx1PudN7s7UaoQ+2hx
GemUYtulqk621LSfuCmgCx0OTgCXnlixMUYDoBRp8LFACdTXJPAShZm8hQKBgF7e
DTwYcuTvt/jFCBBww//2xmHqI1G/uVFlmy6lJeMdpELWYBSbphc54S3kRbb1tGyp
CbMjogl6lHbXf2ZaWLsx/ZIJKL5LwEiLY3DqHQql3+kPmXRMVr9xlqb6Pl2JgdEz
El+WaEYraFWk0e+YnYRyyBe+PXYjkn4BLdE00CZtAoGBAIQYURPYjEQP+5ptWvyK
eg5yoin/T9dokEOLLflsABVhE+NhRXgsZRurXdD29hbfJlIC3OP2Ry0L9eqs83AQ
XJJYb+eHfJotE3g5AundYSbK4io85p550SgJk+io4ht/Rg8c57KG3J1vqZr7qpwt
aHhk2PE8H+YXPht4mD0Xi85k
-----END PRIVATE KEY-----');
        config()->set('cloudfront-cookies', [
            'region' => 'us-east-1',
            'key_pair_id' => 'AA12345678',
            'private_key_path' => 'tests/test_private_key.pem',
            'private_key_storage' => 'local',
            'resource' => '/resource/*',
        ]);
    }
}

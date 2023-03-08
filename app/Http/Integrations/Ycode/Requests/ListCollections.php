<?php

namespace App\Http\Integrations\Ycode\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Illuminate\Support\Facades\Cache;
use Saloon\CachePlugin\Contracts\Driver;
use Saloon\CachePlugin\Traits\HasCaching;
use Saloon\CachePlugin\Contracts\Cacheable;
use Saloon\CachePlugin\Drivers\LaravelCacheDriver;
/**
 * List collections
 *
 * @link https://developers.ycode.com/reference/get_collections
 */
class ListCollections extends Request implements Cacheable
{
    use HasCaching;

    /**
     * Define the HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::GET;

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return '/collections';
    }

    /**
     * Resolve the driver responsible for caching
     *
     * @return \Saloon\CachePlugin\Contracts\Driver
     */
    public function resolveCacheDriver (): Driver
    {
        return new LaravelCacheDriver(Cache::store('file'));
    }

    /**
     * Define the cache expiry in seconds
     *
     * @return int
     */
    public function cacheExpiryInSeconds (): int
    {
        return 3600; // One Hour
    }
}

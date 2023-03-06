<?php

namespace App\Http\Integrations\Ycode;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;

class ApiClient extends Connector
{
    use AcceptsJson;

    /**
     * Constructor
     *
     * @param string $apiKey
     */
    public function __construct ()
    {
        $this->withTokenAuth(config('services.ycode.token'));
    }

    /**
     * The Base URL of the API
     *
     * @return string
     */
    public function resolveBaseUrl (): string
    {
        return config('services.ycode.base_url');
    }

    /**
     * Default headers for every request
     *
     * @return string[]
     */
    protected function defaultHeaders(): array
    {
        return [];
    }

    /**
     * Default HTTP client options
     *
     * @return string[]
     */
    protected function defaultConfig(): array
    {
        return [];
    }
}

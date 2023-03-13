<?php

namespace App\Http\Integrations\Data\Requests;

use Saloon\Enums\Method;
use Saloon\Http\SoloRequest;

class GetCountries extends SoloRequest
{
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
        return 'https://restcountries.com/v3.1/all';
    }
}

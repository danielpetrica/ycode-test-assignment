<?php

namespace App\Http\Integrations\Ycode\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
/**
 * Get collection
 *
 * @link https://developers.ycode.com/reference/get_collections-collection-id
 */
class GetCollection extends Request
{
    /**
     * @param string $collection_id
     */
    public function __construct (
        protected string $collection_id
    ) {}
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
        return '/collections/' . $this->collection_id;
    }
}

<?php

namespace App\Http\Integrations\Ycode\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Create collection item
 * For the fields, to provide, they are provided in as the response of GetCollection
 * @link https://developers.ycode.com/reference/post_collections-collection-id-items
 */
class CreateCollectionItem extends Request
{

    public function __construct (
        protected string $collection_id,
        protected array $body
    ) {}

    /**
     * Define the HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::POST;

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return 'collections/' . $this->collection_id . '/items';
    }
}

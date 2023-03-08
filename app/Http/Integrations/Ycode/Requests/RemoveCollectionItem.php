<?php

namespace App\Http\Integrations\Ycode\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Remove collection item
 * The fields to provide they are provided as the response of GetCollection
 * @link https://developers.ycode.com/reference/delete_collections-collection-id-items-item-id
 */
class RemoveCollectionItem extends Request
{
    public function __construct (
        protected string $collection_id,
        protected string $item_id
    ) {}
    /**
     * Define the HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::DELETE;

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return '/collections/'. $this->collection_id . '/items/' . $this->item_id;
    }
}

<?php

namespace App\Http\Integrations\Ycode\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Update collection item
 *
 * The fields to provide they are returned as the response of GetCollection
 * @link https://developers.ycode.com/reference/put_collections-collection-id-items-item-id
 */
class UpdateCollectionItem extends Request  implements HasBody
{
    use HasJsonBody;
    public function __construct (
        protected string $collection_id,
        protected string $item_id
    ) {}

    /**
     * Define the HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::PUT;

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return '/collections/' . $this->collection_id . '/items/' . $this->item_id;
    }
}

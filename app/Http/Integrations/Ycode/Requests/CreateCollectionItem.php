<?php

namespace App\Http\Integrations\Ycode\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Create collection item
 * For the fields, to provide, they are provided in as the response of GetCollection
 * @link https://developers.ycode.com/reference/post_collections-collection-id-items
 */
class CreateCollectionItem extends Request  implements HasBody
{
    use HasJsonBody;
    public function __construct (
        protected string $collection_id
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

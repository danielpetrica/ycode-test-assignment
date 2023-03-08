<?php

namespace App\Http\Integrations\Ycode\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class PatchCollectionItem extends Request
{
    public function __construct (
        protected string $collection_id,
        protected string $item_id,
        protected array $body
    ) {}
    /**
     * Define the HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::PATCH;

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return '/collections/' . $this->collection_id. '/items/' . $this->item_id;
    }
}

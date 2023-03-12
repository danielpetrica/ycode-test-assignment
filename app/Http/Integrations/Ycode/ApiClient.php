<?php

namespace App\Http\Integrations\Ycode;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Contracts\Request;
use Saloon\Http\Paginators\PagedPaginator;
use Saloon\Http\Paginators\OffsetPaginator;

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

    /**
     * Paginate
     *
     * @param \Saloon\Contracts\Request $request
     *
     * @return \Saloon\Http\Paginators\PagedPaginator
     */
    public function paginate(Request $request): PagedPaginator
    {
        $paginator = PagedPaginator::make($this, $request, perPage: 50);

        $paginator->setLimitKeyName('pagination.per_page');
        $paginator->setPageKeyName('pagination.page');
        $paginator->setTotalKeyName('pagination.total');
        return $paginator;
    }
}

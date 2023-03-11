<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Integrations\Ycode\ApiClient;
use App\Http\Integrations\Ycode\Requests\GetCollection;
use App\Http\Integrations\Ycode\Requests\GetCollectionItem;
use App\Http\Integrations\Ycode\Requests\ListCollectionItems;
use App\Http\Integrations\Ycode\Requests\CreateCollectionItem;
use App\Http\Integrations\Ycode\Requests\UpdateCollectionItem;
use App\Http\Integrations\Ycode\Requests\RemoveCollectionItem;

class CollectionController extends \App\Http\Controllers\Controller
{
    public function __construct (
        protected ApiClient $ycode
    ) {}

    /**
     * List collections
     *
     * @return JsonResponse
     * @throws \ReflectionException
     * @throws \Saloon\Exceptions\InvalidResponseClassException
     * @throws \Saloon\Exceptions\PendingRequestException
     */
    public function ListCollections(): JsonResponse
    {
        $request = new \App\Http\Integrations\Ycode\Requests\ListCollections();
        $response = $this->ycode->send($request);
        return  response()->json($response->json(), $response->status());
    }

    /**
     * Get collection
     *
     * @param string $collection_id
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \ReflectionException
     * @throws \Saloon\Exceptions\InvalidResponseClassException
     * @throws \Saloon\Exceptions\PendingRequestException
     */
    public function getCollection (string $collection_id): JsonResponse
    {
        $request = new GetCollection($collection_id);
        $response = $this->ycode->send($request);
        return response()->json($response->json(), $response->status());
    }

    /**
     * List collection items
     *
     * @param string $collection_id
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \ReflectionException
     * @throws \Saloon\Exceptions\InvalidResponseClassException
     * @throws \Saloon\Exceptions\PendingRequestException
     */
    public function listCollectionItems (string $collection_id): JsonResponse
    {
        $request = new ListCollectionItems($collection_id);
        $response = $this->ycode->send($request);
        return response()->json($response->json(), $response->status());
    }

    /**
     * Get collection item
     *
     * @param string $collection_id
     * @param string $item_id
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \ReflectionException
     * @throws \Saloon\Exceptions\InvalidResponseClassException
     * @throws \Saloon\Exceptions\PendingRequestException
     */
    public function getCollectionItem (string $collection_id, string $item_id): JsonResponse
    {
        $request = new GetCollectionItem($collection_id, $item_id);
        $response = $this->ycode->send($request);
        return response()->json($response->json(), $response->status());
    }

    /**
     * @param string                            $collection_id
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \ReflectionException
     * @throws \Saloon\Exceptions\InvalidResponseClassException
     * @throws \Saloon\Exceptions\PendingRequestException
     */
    public function createCollectionItem(string $collection_id, Request $request): JsonResponse {
        $request = new CreateCollectionItem($collection_id, $request->json());
        $response = $this->ycode->send($request);
        return response()->json($response->json(), $response->status());
    }

    /**
     * @param string                   $collection_id
     * @param string                   $item_id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \ReflectionException
     * @throws \Saloon\Exceptions\InvalidResponseClassException
     * @throws \Saloon\Exceptions\PendingRequestException
     */
    public function updateCollectionItem (string $collection_id, string $item_id, Request $request) {
        $request = new UpdateCollectionItem($collection_id, $item_id, $request->json());
        $response = $this->ycode->send($request);
        return response()->json($response->json(), $response->status());
    }

    /**
     * Patch collection item
     *
     * @param string $collection_id
     * @param string $item_id
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \ReflectionException
     * @throws \Saloon\Exceptions\InvalidResponseClassException
     * @throws \Saloon\Exceptions\PendingRequestException
     */
    public function patchCollectionItem (string $collection_id, string $item_id, Request $request): JsonResponse
    {
        $request = new \App\Http\Integrations\Ycode\Requests\PatchCollectionItem($collection_id, $item_id, $request->json());
        $response = $this->ycode->send($request);
        return response()->json($response->json(), $response->status());
    }

    /**
     * @param string $collection_id
     * @param string $item_id
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \ReflectionException
     * @throws \Saloon\Exceptions\InvalidResponseClassException
     * @throws \Saloon\Exceptions\PendingRequestException
     */
    public function removeCollectionItem (string $collection_id, string $item_id): JsonResponse
    {
        $request = new RemoveCollectionItem($collection_id, $item_id);
        $response = $this->ycode->send($request);
        return response()->json($response->json(),  $response->status());
    }
}

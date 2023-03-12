<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Integrations\Ycode\ApiClient;
use App\Http\Integrations\Data\Requests\GetCountries;
use App\Http\Integrations\Ycode\Requests\ListCollectionItems;

/**
 *  We shouldn't expose the Ycode api directly to the presentation layer so we 'proxy' them through this controller
 */
class DataController extends \App\Http\Controllers\Controller
{

    public function getCountries(): JsonResponse
    {
        $request = new GetCountries();
        $countries = $request->send();;
        return response()->json($countries->json(), $countries->status());
    }

    /**
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return JsonResponse
     */
    public function getProducts (Request $request): JsonResponse
    {
        $connector = new ApiClient();
        $getCollections = new ListCollectionItems(config('services.ycode.products_collection_id'));

        // we use the pagination feature of Saloon to ensure we retrieve all elements of the collection.
        $paginator = $connector->paginate($getCollections);
        $collection = $paginator->collect('data');
        $data = $collection->all();

        return response()->json($data, 200);
    }

}

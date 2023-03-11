<?php

namespace App\Http\Controllers\Api;
use Saloon\Laravel\Facades\Saloon;
use App\Http\Integrations\Data\Requests\GetCountries;

class DataController extends \App\Http\Controllers\Controller
{

    public function getCountries(): \Illuminate\Http\JsonResponse
    {
        $request = new GetCountries();
        $countries = $request->send();;
        return response()->json($countries->json(), $countries->status());
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

/**
 * @class CheckoutController
 */
class CheckoutController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('checkout.index');
    }

    /**
     * @todo: complete function
     * @return \Illuminate\Http\JsonResponse
     */
    public function postOrder():JsonResponse {
        // create the order item
        // create the order - product pivot table items
        return response()->json('ok');
    }
}

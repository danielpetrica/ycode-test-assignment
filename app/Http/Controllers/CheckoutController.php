<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Integrations\Ycode\ApiClient;
use Saloon\Exceptions\PendingRequestException;
use Saloon\Exceptions\InvalidResponseClassException;
use App\Http\Integrations\Ycode\Requests\ListCollectionItems;
use App\Http\Integrations\Ycode\Requests\CreateCollectionItem;

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
    public function postOrder(Request $request):JsonResponse {
        $data = $request->all();
        $connector = new ApiClient();
        $listCollectionItems = new ListCollectionItems( config('services.ycode.orders_collection_id'));

        $subTotal = 0;
        foreach ($data['order'] as $product) {
            $subTotal += $product['product']['Price'] * $product['quantity'];
        }

        // The shipping cost is fixed, but it should be calculated based on the shipping address by an external api
        $shipping = 5;
        // create the order item
        $request = new CreateCollectionItem(
            config('services.ycode.orders_collection_id')
        );
        $request
            ->body()
            ->set([
                      'Customer name' => $data['firstName'] . ' ' . $data['lastName'],
                      'Email' => $data['email'],
                      'Phone' => $data['phone'],
                      'Address line 1' => $data['address'],
                      'Address line 2' => $data['apartment'],
                      'City' => $data['city'],
                      'State' => $data['state'],
                      'Country' => $data['country'],
                      'Zip' => $data['postal'],
                      'Total' => $subTotal + $shipping,
                      'Subtotal' => $subTotal,
                      'Shipping' => $shipping,
                  ]);
        try
        {
            $order = $connector->send($request);
        }
        catch (\Exception $e) {
            return response()->json("Error while placing the order", 500);
        }
        $orderObject = $order->json();

        // the order has not been placed
        if (!$order->successful()) {
            return response()->json("Order has not been created", $order->status());
        }

        // create the order - product pivot table items
        try
        {
            foreach ($data['order'] as $product) {
                $request = new CreateCollectionItem(
                    config('services.ycode.orders_items_collection_id')
                );
                $request
                    ->body()
                    ->set([
                              'Order' => $orderObject['_ycode_id'],
                              'Product' => $product['product']['_ycode_id'],
                              'Quantity' => (int) $product['quantity'],
                          ]);
                $pivot = $connector->send($request);
            }
        } catch (Exception $exception) {
            return response()->json("Couldn't place the order correctly", 500);
        }

        return response()->json($orderObject, $order->status());
    }
}

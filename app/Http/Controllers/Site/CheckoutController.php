<?php

namespace App\Http\Controllers\Site;

use App\Contracts\OrderContract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderContract $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
    public function getCheckout()
    {
        return view('site.pages.checkout');
    }

    public function placeOrder(Request $request)
    {
        //Before storing the order, should implement
        //the request validation
        $this->validate($request, [
            'first_name'        => 'required|max:191',
            'last_name'         => 'required|max:191',
            'address'           => 'required',
            'city'              => 'required',
            'country'           => 'required',
            'post_code'         => 'required',
            'phone_number'      => 'required',

        ]);

        $order = $this->orderRepository->storeOrderDetails($request->all());

        dd($order);
    }
}

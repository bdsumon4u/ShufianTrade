<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use function auth;

class OrderController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('user.orders', [
            'orders' => auth('user')->user()->orders()->latest('id')->paginate(6),
        ]);
    }
}

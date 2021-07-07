<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

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
//        dd(Order::query()->first());
        $orders = Order::when($request->has('status'), function ($query) {
            $query->where('status', 'like', \request('status'));
        })->when(!$request->has('order'), function ($query) {
            $query->latest('id');
        });


        return DataTables::of($orders)
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return "<div class='text-nowrap'>" . $row->created_at->format('d-M-Y') . "<br>" . $row->created_at->format('h:i A') . "</div>";
            })
            ->editColumn('price', function ($row) {
                return $row->data->subtotal + $row->data->shipping_cost;
            })
            ->addColumn('actions', function (Order $order) {
                return '<div class="d-flex justify-content-center">
                    <a href="'.route('admin.orders.show', $order).'" class="btn btn-sm btn-primary px-2 d-block">View</a>
                    <a href="'.route('admin.orders.edit', $order).'" class="btn btn-sm btn-success px-2 d-block">Edit</a>
                    <a href="'.route('admin.orders.destroy', $order).'" data-action="delete" class="btn btn-sm btn-danger px-2 d-block">Delete</a>
                </div>';
            })
//            ->filterColumn('created_at', function($query, $keyword) {
//                $query->where('created_at', 'like', "%" . Carbon::createFromFormat('d-M-Y', $keyword)->format('Y-m-d') ."%");
//            })
            ->rawColumns(['created_at', 'actions'])
            ->make(true);
    }
}

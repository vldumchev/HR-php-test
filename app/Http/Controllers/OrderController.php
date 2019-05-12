<?php

namespace App\Http\Controllers;

use App\Order;
use App\Partner;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index()
    {
        $expired = Order::with('partner')
            ->where('status', 10)
            ->where('delivery_dt', '<', Carbon::now()->toDateTimeString())
            ->orderBy('delivery_dt', 'desc')
            ->limit(50)
            ->get();

        $current = Order::with('partner')
            ->where('status', 10)
            ->whereBetween('delivery_dt', [
                Carbon::now()->toDateTimeString(),
                Carbon::now()->addHours(24)->toDateTimeString()
            ])
            ->orderBy('delivery_dt', 'asc')
            ->get();

        $new     = Order::with('partner')
            ->where('status', 0)
            ->where('delivery_dt', '>', Carbon::now()->toDateTimeString())
            ->orderBy('delivery_dt', 'asc')
            ->limit(50)
            ->get();

        $done    = Order::with('partner')
            ->where('status', 20)
            ->whereBetween('delivery_dt', [
                Carbon::now()->toDateString(),
                Carbon::now()->addHours(24)->toDateString()
            ])
            ->orderBy('delivery_dt', 'desc')
            ->limit(50)
            ->get();

        return view('orders.list', [
            'groupedOrders' => [
                'expired' => $expired,
                'current' => $current,
                'new'     => $new,
                'done'    => $done
            ]
        ]);
    }

    public function edit($id, $errors = [])
    {
        return view('orders.edit', [
            'errors'   => $errors,
            'order'    => Order::with('partner')->where('id', $id)->first(),
            'partners' => Partner::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $email   = $request->input('email');
        $partner = $request->input('partner');
        $status  = $request->input('status');

        $errors = [];

        if (!isset($email)) {
            $errors['email'] = 'Email не указан';
        }

        if (!isset($partner)) {
            $errors['partner'] = 'Партнёр не указан';
        }

        if (!isset($status)) {
            $errors['status'] = 'Статус не указан';
        }

        if (empty($errors)) {
            $order = Order::find($id);

            $order->client_email = $email;
            $order->partner_id   = $partner;
            $order->status       = $status;

            $order->save();
        }

        return $this->edit($id, $errors);
    }
}

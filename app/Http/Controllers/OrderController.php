<?php

namespace App\Http\Controllers;

use App\Order;
use App\Partner;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders.list', ['orders' => Order::with('partner')->paginate(15)]);
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

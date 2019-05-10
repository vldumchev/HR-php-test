<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $appends = ['price'];

    public function partner()
    {
        return $this->belongsTo('App\Partner');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product', 'order_products');
    }

    public function getPriceAttribute()
    {
        $totalPrice = 0;

        if (isset($this->products)) {
            foreach ($this->products as $product) {
                $totalPrice += $product->price;
            }
        }

        return $totalPrice;
    }
}

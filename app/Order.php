<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function partner()
    {
        return $this->belongsTo('App\Partner');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product', 'order_products');
    }
}

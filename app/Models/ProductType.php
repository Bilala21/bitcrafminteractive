<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    public function coupons()
    {
        return $this->hasMany(Coupon::class,'product_type_id');
    }
}

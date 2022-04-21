<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'link',
        'coupon_code',
        'product_type_id',
        'website_name',
        'actual_price',
        'discounte_price',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function produtType(){
        return $this->belongsTo(ProductType::class,'product_type_id');
    }

    public function favourite(){
        return $this->hasMany(Favourite::class);
    }
}

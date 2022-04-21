<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Models\product_type;
use App\Models\ProductType;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function adminDashboard()
    {
        $users = User::withCount('coupons')->where('role', 'User')->get();
        return view('admin.admin', ["users"=>$users]);
    }

    public function userDashboard()  
    {
        // $coupons=Coupon::all();
        $coupons=Coupon::where('user_id',auth()->user()->id)->get();
        return view('user.user',["couponsData" =>$coupons]);
    }

    public function addNewCoupon()
    {
        $productType= ProductType::all();
        // // $coupons = Coupon::where('user_id', Auth::id())->get();
        // return view('user.addNewCoupon', ["productType"=>$productType]);
        return view('user.addNewCoupon',["productType" => $productType]);
    }
}

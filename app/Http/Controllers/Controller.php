<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\product_type;
use App\Models\ProductType;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function homePage()
    {
        $data = Coupon::get();
        return view('home', ['couponsData' => $data]);
    }

    public function searchCoupon(Request $request)
    {
        $request->validate([
            "searchText" => "required"
        ], ["searchText.required" => "Please enter something"]);
        $data = Coupon::where('name', 'LIKE', '%' . $request->searchText . '%')->with('produtType')->get();
        if (count($data)) {
            return view('coupons.search-result', ['couponsData' => $data]);
        } else {
            return view('coupons.search-result', ['couponsData' => $data]);
        }
    }

    public function discountedCoupon()
    {
        $data = Coupon::where('actual_price', '<>', [0])->where('discounte_price', '<>', [0])->get();
        if (!count($data)) {
            return view('coupons.discounted-coupon', ['couponsData' => "Result is not found"]);
        } else {
            return view('coupons.discounted-coupon', ['couponsData' => $data]);
        }
    }
    public function paidCoupon()
    {

        $data = Coupon::where("discounte_price", '=', 0)->where("actual_price", '<>', 0)->get();
        if (!count($data)) {
            return view('coupons.paid-coupon', ['couponsData' => "Result is not found"]);
        } else {
            return view('coupons.paid-coupon', ['couponsData' => $data]);
        }
    }
    public function freeCoupon()
    {
        $data = Coupon::where('actual_price', '=', [0])->where('discounte_price', '=', [0])->get();
        if (!count($data)) {
            return view('coupons.unpaid-coupin', ['couponsData' => "Result is not found"]);
        } else {
            return view('coupons.unpaid-coupin', ['couponsData' => $data]);
        }
    }
}

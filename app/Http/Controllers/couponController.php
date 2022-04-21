<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Favourite;
use App\Models\product_type;
use App\Models\ProductType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Stringable;

use function PHPUnit\Framework\isEmpty;

class couponController extends Controller
{
    public function addCoupon(Request $req)
    {

        $validated = $req->validate([
            'name' => ['required'],
            'link' => ['required'],
            'coupon_code' => ['required'],
            'product_type' => ['required', 'numeric'],
            'acprice' => ['required'],
            'disprice' => ['required'],

        ]);

        if (Str::startsWith($req->link, 'https://www')) {
            $domain = substr($req->link, 12);
            $name = explode('.', $domain);
            $validated['website_name'] = $name[0];
        } else if (Str::startsWith($req->link, 'https://')) {
            $domain = substr($req->link, 8);
            $name = explode('.', $domain);
            $validated['website_name'] = $name[0];
        } else if (Str::startsWith($req->link, 'http://')) {
            $domain = substr($req->link, 7);
            $name = explode('.', $domain);
            $validated['website_name'] = $name[0];
        }
        $validated['user_id'] = $req->user()->id;
        Coupon::create([
            "name" => $validated['name'],
            "link" => $validated['link'],
            "coupon_code" => $validated['coupon_code'],
            "website_name" => $validated['website_name'],
            "actual_price" => $validated['acprice'],
            "discounte_price" => $validated['disprice'],
            "product_type_id" => $validated['product_type'],
            "user_id" => $validated['user_id']
        ]);

        return redirect()->route('user-coupons');
    }

    public function getUserCoupons($id)
    {
        $coupons = Coupon::where('user_id', $id)->get();
        return view('user.user', ['coupons' => $coupons]);
    }

    public function deleteCoupon($id)
    {
        $coupons = Coupon::find($id);
        $user_id = $coupons->user_id;
        $coupons->delete();
        return redirect()->route('user-coupons', ['id' => $user_id]);
    }




}

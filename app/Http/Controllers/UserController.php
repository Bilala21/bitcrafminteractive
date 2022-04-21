<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function disableUser($id)
    {
        $user = User::find($id);
        $user->disabled = 1;
        $user->save();

        return redirect()->route('admin');
    }

    public function enableUser($id)
    {
        $user = User::find($id);
        $user->disabled = 0;
        $user->save();

        return redirect()->route('admin');
    }

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

    public function favouriteCoupon($id)
    {
        $data = Favourite::create([
            "coupon_id" => $id,
            "user_id" => auth()->user()->id,
        ]);
        if ($data) {
            return response()->json(["status" => 200, "data" => "yes"]);
        }
    }

    public function showFavouriteCoupon()
    {
        $data = DB::select(" 
        select * from coupons co
        inner join product_types pt
        on co.product_type_id = pt.id
        inner join favourites fa
        on co.id=fa.coupon_id
        where fa.user_id= ?
        ", [auth()->user()->id]);
        if (!count($data)) {
            return view('user.paid-coupon', ['couponsData' => []]);
        } else {
            return view('user.favourite-coupons', ['couponsData' => $data]);
        }
    }

    public function searchCouponUser(Request $request)
    {
        $request->validate([
            "searchText" => "required"
        ], ["searchText.required" => "Please enter something"]);
        $data = Coupon::where('name', 'LIKE', '%' . $request->searchText . '%')->with('produtType')->get();
        if (count($data)) {
            return view('user.search-result', ['couponsData' => $data]);
        } else {
            return view('user.search-result', ['couponsData' => $data]);
        }
    }

    public function discountedCoupon()
    {
        $data = Coupon::where("user_id", auth()->user()->id)->where('actual_price', '<>', [0])->where('discounte_price', '<>', [0])->get();
        if (!count($data)) {
            return view('user.discounted-coupon', ['couponsData' => []]);
        } else {
            return view('user.discounted-coupon', ['couponsData' => $data]);
        }
    }

    public function paidCoupon()
    {

        $data = Coupon::where("user_id", auth()->user()->id)->where("discounte_price", '=', 0)->where("actual_price", '<>', 0)->get();
        if (!count($data)) {
            return view('user.paid-coupon', ['couponsData' => []]);
        } else {
            return view('user.paid-coupon', ['couponsData' => $data]);
        }
    }


    public function freeCoupon()
    {
        $data = Coupon::where("user_id", auth()->user()->id)->where('actual_price', '=', [0])->where('discounte_price', '=', [0])->get();
        // dd(gettype($data));
        if (!count($data)) {
            return view('user.unpaid-coupin',['couponsData' => []]);
        } else {
            return view('user.unpaid-coupin', ['couponsData' => $data]);
        }
    }

    public function edit_coupon($id){
        $data = Coupon::where("id", $id)->get();
  
        if (!count($data)) {
            return view('user.edit_form',['couponsData' => []]);
        } else {
            return view('user.edit_form', ['couponsData' => $data]);
        }

    }
}

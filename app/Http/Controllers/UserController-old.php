<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

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
}

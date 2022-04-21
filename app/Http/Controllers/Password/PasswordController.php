<?php

namespace App\Http\Controllers\Password;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function setPassword(Request $request)
    {
        $request->validate([
            'password' => ['required']
        ]);
    }
}

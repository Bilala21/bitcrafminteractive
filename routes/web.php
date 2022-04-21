<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\couponController;
use App\Http\Controllers\Password\PasswordController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRegisterController;
use App\Models\Coupon;
use App\Models\Favourite;
use App\Models\ProductType;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Homepage
Route::get('/', [Controller::class, 'homePage'])->name('home');
Route::get("/discounted", [Controller::class,'discountedCoupon'])->name('discounted');
Route::get("/paid-coupon", [Controller::class,'paidCoupon'])->name('paid-coupon');
Route::get("/unpaid-free", [Controller::class,'freeCoupon'])->name('unpaid-free');
Route::get('/search-coupon', [Controller::class, 'searchCoupon'])->name('search-coupon');

// Login Page
Route::get('/main', function(){
    return view('custom-auth.register');
})->name('main');

// Admin
Route::prefix('admin')->middleware(['auth', 'verified'])->group(function(){
    Route::get('/', [RoleController::class, 'adminDashboard'])->middleware(['can:admin'])->name('admin');
    Route::get('/disable-user/{id}', [UserController::class, 'disableUser'])->name('disable-user');
    Route::get('/enable-user/{id}', [UserController::class, 'enableUser'])->name('enable-user');
    Route::get('/user-coupons/{id}', [couponController::class, 'getUserCoupons'])->name('user-coupons');
    Route::get('/delete-coupon/{id}', [couponController::class, 'deleteCoupon'])->name('delete-coupon');
});

// User
Route::prefix('user')->middleware(['auth', 'verified'])->group(function(){
    Route::get('/', [RoleController::class, 'userDashboard'])->name('user');
    Route::post('addCoupon',[UserController::class,'addCoupon'])->name('addCoupon');
    Route::get('/addNewCoupon', [RoleController::class, 'addNewCoupon'])->name('addNewCoupon');
    Route::get('/search-user-coupons', [UserController::class, 'searchCouponUser'])->name('search-user-coupons');
    Route::get("/favourite-coupon/{id}", [UserController::class,'favouriteCoupon']);
    Route::get("/show-favourite-coupon", [UserController::class,'showFavouriteCoupon'])->name('show-favourite-coupon');
    Route::get("/discounted-coupons", [UserController::class,'discountedCoupon'])->name('discounted-coupons');
    Route::get("/paid-coupons", [UserController::class,'paidCoupon'])->name('paid-coupons');
    Route::get("/unpaid-coupons", [UserController::class,'freeCoupon'])->name('unpaid-coupons');
    Route::get("/edit-coupon/{id}", [UserController::class,'edit_coupon'])->name('edit-coupon');
});

Route::prefix('registration')->group(function(){
    Route::get('/signup', function(){
        return view('custom-auth.register');
    })->name('registration');

    Route::get('/password', function(){
        return view('custom-auth.password');
    })->name('password');

    Route::post('/set-password', [PasswordController::class, 'setPassword'])->name('set-password');
});

Route::post('cust-register', [UserRegisterController::class, 'store'])->name('cust-register');

require __DIR__.'/auth.php';


Route::get('/testing', function(){

    $data=DB::select(

        "
        select * from vadfjmmy_mammoth_interactive.coupons co
        inner join vadfjmmy_mammoth_interactive.product_types pt
        on co.product_type_id = pt.id
        inner join vadfjmmy_mammoth_interactive.favourites fa
        on co.id=fa.coupon_id
        where fa.user_id=1
        "
    );
    dd($data);
    // foreach($data as $item){
    //     echo $item->name;
    // }
});

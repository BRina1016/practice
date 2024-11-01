<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

// ホームページ
Route::get('/', [StoreController::class, 'index']);

// 店舗一覧ページ
Route::get('/stores', [StoreController::class, 'index'])->name('store.index');

// 店舗の詳細ページ
Route::get('/detail/{store_id}', [StoreController::class, 'show'])->name('store.detail');

Route::post('/detail/{store_id}/complete', [ReservationController::class, 'completeReservation'])
    ->middleware('auth')
    ->name('reservation.store');

// ユーザー登録関連
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/thanks', function () {return view('thanks');})->name('thanks');
Route::post('/login', [LoginController::class, 'login'])->name('login');

// ユーザーログイン・ログアウト関連
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/logout', function (Request $request) {
    Auth::logout();
    $previousUrl = $request->header('referer');

    if (parse_url($previousUrl, PHP_URL_PATH) === '/mypage') {
        return redirect('/');
    }

    return redirect()->back();
})->name('logout');

// マイページ
Route::get('/mypage', [MyPageController::class, 'index'])->name('mypage');

// 予約関連
Route::post('/detail/{store_id}/complete', [ReservationController::class, 'completeReservation'])->name('reservation.store');
Route::get('/done', [ReservationController::class, 'showDonePage'])->name('reservation.done');

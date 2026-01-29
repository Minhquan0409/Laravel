<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckTimeAccess;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

// Nhóm route /product
Route::prefix('product')->middleware(CheckTimeAccess::class)->group(function () {

    // Danh sách sản phẩm (có nút thêm mới)
    Route::get('/', [ProductController::class, 'index'])->name('product.index');
        $products = [
            ['id' => 1, 'name' => 'Laptop Dell XPS 13', 'price' => 28000000],
            ['id' => 2, 'name' => 'iPhone 15 Pro', 'price' => 28990000],
            ['id' => 3, 'name' => 'Tai nghe Sony WH-1000XM5', 'price' => 8490000],
        ];

        return view('product.index', compact('products'));
    })->name('index');

    // Form thêm mới sản phẩm
    Route::get('/add', [ProductController::class, 'add'])->name('product.add');

    // Chi tiết sản phẩm (id là chuỗi, mặc định 123)
    Route::get('/{id}', [ProductController::class, 'show'])->where('id', '[a-zA-Z0-9]+')->name('product.show');

// Route sinh viên
Route::get('/sinhvien/{name?}/{mssv?}', function ($name = 'Truong Minh Quan', $mssv = '4009567') {
    return "Thông tin giới thiệu của sinh viên:<br>" .
           "<strong>Họ và tên:</strong> " . e($name) . "<br>" .
           "<strong>MSSV:</strong> " . e($mssv);
})->name('sinhvien.info');

// Route bàn cờ vua n×n
Route::get('/banco/{n?}', function ($n = 8) {
    if (!is_numeric($n) || $n < 1 || $n > 20) {
        $n = 8;
    }
    return view('banco', compact('n'));
})->name('banco');

// 404 fallback (Laravel tự xử lý, nhưng có thể custom)
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

// Route login
Route::get('/signin', [AuthController::class, 'signin'])->name('auth.signin');
Route::post('/signin', [AuthController::class, 'checkSignin'])->name('auth.checkSignin');

// Route signup
Route::get('/signup', [AuthController::class, 'signup'])->name('auth.signup');
Route::post('/signup', [AuthController::class, 'checkSignup'])->name('auth.checkSignup');

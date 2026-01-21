<?php

use Illuminate\Support\Facades\Route;

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
Route::prefix('product')->name('product.')->group(function () {

    // Danh sách sản phẩm (có nút thêm mới)
    Route::get('/', function () {
        $products = [
            ['id' => 1, 'name' => 'Laptop Dell XPS 13', 'price' => 28000000],
            ['id' => 2, 'name' => 'iPhone 15 Pro', 'price' => 28990000],
            ['id' => 3, 'name' => 'Tai nghe Sony WH-1000XM5', 'price' => 8490000],
        ];

        return view('product.index', compact('products'));
    })->name('index');

    // Form thêm mới sản phẩm
    Route::get('/add', function () {
        return view('product.add');
    })->name('add');

    // Chi tiết sản phẩm (id là chuỗi, mặc định 123)
    Route::get('/{id?}', function ($id = '123') {
        return view('product.show', ['id' => $id]);
    })->where('id', '[A-Za-z0-9-]+')->name('show');

});

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

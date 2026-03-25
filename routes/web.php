<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckTimeAccess;
use App\Http\Middleware\CheckAge;

// Route home
// Ví dụ về named route: đặt tên route bằng ->name('home')
// Gọi route qua tên: route('home') hoặc {{ route('home') }} trong Blade
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/admin', function () {
    return view('layout.admin');
})->name('layout.admin');

// Route hiển thị form nhập tuổi
Route::get('/age', function () {
    return view('age');
})->name('age.index');

// Route lưu tuổi vào session
Route::post('/age', function () {
    $age = request()->input('age');
    session(['age' => $age]);
    return redirect()->route('age.index')->with('success', 'Tuổi đã được lưu!');
})->name('age.store');

// Nhóm route product - áp dụng middleware kiểm tra tuổi
Route::prefix('product')->middleware([CheckAge::class])->group(function () {
    // Route danh sách sản phẩm
    Route::get('/', [ProductController::class, 'index'])->name('product.index');
    
    // Route form thêm mới sản phẩm
    Route::get('/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('/add', [ProductController::class, 'add'])->name('product.add'); // Alias cho create
    
    // Route lưu sản phẩm mới
    Route::post('/store', [ProductController::class, 'store'])->name('product.store');
    
    // Route form chỉnh sửa sản phẩm
    Route::get('/{id}/edit', [ProductController::class, 'edit'])->where('id', '[0-9]+')->name('product.edit');
    
    // Route cập nhật sản phẩm
    Route::put('/{id}', [ProductController::class, 'update'])->where('id', '[0-9]+')->name('product.update');
    Route::patch('/{id}', [ProductController::class, 'update'])->where('id', '[0-9]+');
    
    // Route xóa sản phẩm
    Route::delete('/{id}', [ProductController::class, 'destroy'])->where('id', '[0-9]+')->name('product.destroy');
});

// Route sinh viên với giá trị mặc định
Route::get('/sinhvien/{name?}/{mssv?}', function ($name = 'Luong Xuan Hieu', $mssv = '123456') {
    // Nếu không có tham số, hiển thị thông tin sinh viên làm bài
    if (request()->route()->parameter('name') === null) {
        $name = 'Truong Minh Quan';
        $mssv = '4009567';
    }
    return view('sinhvien', ['name' => $name, 'mssv' => $mssv]);
})->name('sinhvien');

// Route bàn cờ vua
Route::get('/banco/{n}', function ($n) {
    return view('banco', ['n' => (int)$n]);
})->where('n', '[0-9]+')->name('banco');

// Route login
Route::get('/signin', [AuthController::class, 'signin'])->name('auth.signin');
Route::post('/signin', [AuthController::class, 'checkSignin'])->name('auth.checkSignin');

// Route signup
Route::get('/signup', [AuthController::class, 'signup'])->name('auth.signup');
Route::post('/signup', [AuthController::class, 'checkSignup'])->name('auth.checkSignup');

// Nhóm route category
Route::prefix('category')->group(function () {
    // Route danh sách danh mục
    Route::get('/', [CategoryController::class, 'index'])->name('category.index');
    
    // Route form thêm mới danh mục
    Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
    Route::get('/add', [CategoryController::class, 'add'])->name('category.add'); // Alias cho create
    
    // Route lưu danh mục mới
    Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
    
    // Route form chỉnh sửa danh mục
    Route::get('/{id}/edit', [CategoryController::class, 'edit'])->where('id', '[0-9]+')->name('category.edit');
    
    // Route cập nhật danh mục
    Route::put('/{id}', [CategoryController::class, 'update'])->where('id', '[0-9]+')->name('category.update');
    Route::patch('/{id}', [CategoryController::class, 'update'])->where('id', '[0-9]+');
    
    // Route xóa danh mục (soft delete)
    Route::delete('/{id}', [CategoryController::class, 'destroy'])->where('id', '[0-9]+')->name('category.destroy');
});
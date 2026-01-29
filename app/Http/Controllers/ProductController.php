<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;                    
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;       
use App\Http\Middleware\CheckTimeAccess;

class ProductController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            CheckTimeAccess::class,
        ];
    }

    public function index()
    {
        return view('product.index');
    }

    public function add()
    {
        return view('product.add');
    }
    
    public function show($id)
    {
        return view('product.show', ['id' => $id]);
    }
}

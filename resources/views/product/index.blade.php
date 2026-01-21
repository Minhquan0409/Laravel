@extends('layouts.app') 

@section('content')
    <h1>Danh sách sản phẩm</h1>
    
    <a href="{{ route('product.add') }}" class="btn btn-success mb-3">+ Thêm sản phẩm mới</a>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Giá</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td><a href="{{ route('product.show', $product['id']) }}">{{ $product['id'] }}</a></td>
                <td>{{ $product['name'] }}</td>
                <td>{{ number_format($product['price']) }} ₫</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
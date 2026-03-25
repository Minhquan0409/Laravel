@extends('layout.admin')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Danh sách sản phẩm</h3>
        <a href="{{ route('product.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Thêm sản phẩm mới
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mb-3">
        <div class="card-body">
            <form action="{{ route('product.index') }}" method="GET" class="row">
                <div class="col-md-5 mb-2 mb-md-0">
                    <input
                        type="text"
                        name="keyword"
                        class="form-control"
                        placeholder="Tìm theo tên sản phẩm..."
                        value="{{ $keyword }}"
                    >
                </div>
                <div class="col-md-4 mb-2 mb-md-0">
                    <select name="category_id" class="form-control">
                        <option value="">-- Tất cả danh mục --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ (string) $categoryId === (string) $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 text-md-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Lọc
                    </button>
                    <a href="{{ route('product.index') }}" class="btn btn-secondary">
                        Đặt lại
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-bordered table-hover mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Giá</th>
                        <th>Giá khuyến mãi</th>
                        <th>Tồn kho</th>
                        <th>Trạng thái</th>
                        <th style="width: 180px;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category?->name ?? '-' }}</td>
                    <td>{{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>{{ $product->sale_price !== null ? number_format($product->sale_price, 0, ',', '.') : '-' }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        @if ($product->is_active)
                            <span class="badge badge-success">Đang bán</span>
                        @else
                            <span class="badge badge-secondary">Ẩn</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning btn-sm mr-1">
                            Sửa
                        </a>
                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                Xóa
                            </button>
                        </form>
                    </td>
                </tr>
                    @empty
                <tr>
                    <td colspan="8" class="text-center py-4">
                        Chưa có sản phẩm nào. <a href="{{ route('product.create') }}">Thêm sản phẩm mới</a>
                    </td>
                </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
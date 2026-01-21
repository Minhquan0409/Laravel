<h1>Thêm sản phẩm mới</h1>

<form method="POST" action="#">
    @csrf
    <div class="mb-3">
        <label>Tên sản phẩm</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <label>Giá</label>
        <input type="number" name="price" class="form-control" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Lưu sản phẩm</button>
    <a href="{{ route('product.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
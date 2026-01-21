<!DOCTYPE html>
<html>
<head>
    <title>Trang chủ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h1>Chào mừng đến với Quản lý sản phẩm</h1>
    <a href="{{ route('product.index') }}" class="btn btn-primary">Xem danh sách sản phẩm</a>
    <a href="{{ route('banco') }}" class="btn btn-success">Xem bàn cờ vua 8×8</a>
</body>
</html>
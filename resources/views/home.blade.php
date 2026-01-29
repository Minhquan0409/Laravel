<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .nav-links {
            text-align: center;
            margin-top: 30px;
        }
        .nav-links a {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            background: #3562A6;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .nav-links a:hover {
            background: #0E1E5B;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Chào mừng đến với Quản lý sản phẩm</h1>
        <div class="nav-links">
            <a href="{{ route('home') }}">Trang chủ</a>
            <a href="{{ route('auth.signin') }}">Đăng nhập</a>
            <a href="{{ route('product.index') }}">Xem danh sách sản phẩm</a>
            <a href="{{ route('sinhvien.info') }}">Sinh viên</a>
            <a href="{{ route('banco', ['n' => 8]) }}">Xem bàn cờ vua 8×8</a>
        </div>
    </div>
</body>
</html>
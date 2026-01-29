<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin sinh viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
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
            border-bottom: 3px solid #007bff;
            padding-bottom: 10px;
        }
        .info-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .info-item {
            margin: 15px 0;
            font-size: 18px;
        }
        .info-label {
            font-weight: bold;
            color: #007bff;
            display: inline-block;
            width: 150px;
        }
        .info-value {
            color: #333;
        }
        .nav-link {
            display: inline-block;
            margin-top: 20px;
            padding: 8px 16px;
            background: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .nav-link:hover {
            background: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Thông tin sinh viên</h1>
        
        <div class="info-card">
            <div class="info-item">
                <span class="info-label">Họ và tên:</span>
                <span class="info-value">{{ $name }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Mã số SV:</span>
                <span class="info-value">{{ $mssv }}</span>
            </div>
        </div>
        
        <a href="{{ route('home') }}" class="nav-link">← Về trang chủ</a>
    </div>
</body>
</html>


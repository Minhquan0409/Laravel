<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            box-sizing: border-box;
        }
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
        .form-group {
            margin: 20px 0;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #007bff;
        }
        input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: white;
            border: none;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .nav-links {
            text-align: center;
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }
        .nav-link {
            display: inline-block;
            margin-top: 20px;
            color: #6c757d;
            text-decoration: none;
        }
        .nav-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Signin</h1>

    <form action="{{ route('auth.checkSignin') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password">
        </div>

        <div class="form-group">
            <label>Repass</label>
            <input type="password" name="repass">
        </div>

        <div class="form-group">
            <label>Mssv</label>
            <input type="text" name="mssv">
        </div>

        <div class="form-group">
            <label>Class</label>
            <input type="text" name="class">
        </div>

        <div class="form-group">
            <label>Gender</label>
            <input type="text" name="gender">
        </div>

        <button type="submit">Signin</button>
    </form>
    <div class="nav-links">
        <a href="{{ route('home') }}" class="nav-link">← Về trang chủ</a>
        <a href="{{ route('auth.signup') }}" class="nav-link">Chưa có tài khoản? Đăng ký</a>
    </div>
</div>
</body>
</html>

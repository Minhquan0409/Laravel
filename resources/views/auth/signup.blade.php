<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
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
            border-bottom: 3px solid #28a745;
            padding-bottom: 10px;
        }
        .form-group {
            margin: 20px 0;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #28a745;
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
            background: #28a745;
            color: white;
            border: none;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #1e7e34;
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
    <h1>Signup</h1>

    <form action="{{ route('auth.checkSignup') }}" method="POST">
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

        <button type="submit">Signup</button>
    </form>

    <a href="{{ route('auth.signin') }}" class="nav-link">← Đã có tài khoản? Đăng nhập</a>
</div>
</body>
</html>

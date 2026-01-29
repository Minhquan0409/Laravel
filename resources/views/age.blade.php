<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhập tuổi</title>
</head>
<body>
    <h2>Nhập tuổi của bạn</h2>

    <form action="/save-age" method="post">
        @csrf
        <label for="age">Tuổi:</label>
        <input type="number" name="age" id="age" required><br>
        <button type="submit">Lưu</button>
    </form>
</body>
</html>
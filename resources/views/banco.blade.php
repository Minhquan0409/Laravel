<!DOCTYPE html>
<html>
<head>
    <title>Bàn cờ {{ $n }}×{{ $n }}</title>
    <style>
        table { border-collapse: collapse; margin: 20px auto; }
        td { width: 40px; height: 40px; text-align: center; font-size: 24px; }
        .white { background: #f0d9b5; }
        .black { background: #b58863; }
    </style>
</head>
<body>
    <h1 style="text-align:center">Bàn cờ vua {{ $n }}×{{ $n }}</h1>
    
    <table>
        @for ($i = 0; $i < $n; $i++)
            <tr>
                @for ($j = 0; $j < $n; $j++)
                    <td class="{{ ($i + $j) % 2 == 0 ? 'white' : 'black' }}">
                    </td>
                @endfor
            </tr>
        @endfor
    </table>
    
    <p style="text-align:center">
        <a href="{{ route('banco', 8) }}">8×8</a> |
        <a href="{{ route('banco', 10) }}">10×10</a> |
        <a href="{{ route('banco', 12) }}">12×12</a>
    </p>
</body>
</html>
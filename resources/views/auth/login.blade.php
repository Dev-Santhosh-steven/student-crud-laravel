<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
        }
        .login-box {
            width: 350px;
            margin: 100px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #0d6efd;
            border: none;
            color: white;
            cursor: pointer;
        }
        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Admin Login</h2>

    @if ($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ url('/login') }}">
        @csrf

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>

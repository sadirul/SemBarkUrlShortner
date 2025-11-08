{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <style>
        body {
            font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            background: #f7f7f7;
        }

        .wrap {
            max-width: 380px;
            margin: 8vh auto;
            background: #fff;
            padding: 18px 16px;
            border: 1px solid #eee;
            border-radius: 8px;
        }

        h1 {
            font-size: 18px;
            margin: 0 0 14px;
        }

        label {
            display: block;
            font-size: 13px;
            margin: 10px 0 6px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            outline: none;
        }

        input:focus {
            border-color: #999;
        }

        .error {
            color: #b42318;
            font-size: 12px;
            margin-top: 6px;
        }

        .btn {
            width: 100%;
            margin-top: 14px;
            padding: 10px;
            border: 0;
            border-radius: 6px;
            background: #111;
            color: #fff;
            cursor: pointer;
        }

        .btn:disabled {
            opacity: .7;
            cursor: not-allowed;
        }

        .hint {
            font-size: 12px;
            color: #666;
            margin-top: 8px;
        }
    </style>
</head>

<body>
    <div class="wrap">
        <h1>Login</h1>
        @include('alert.alert')
        <form method="POST" action="{{ route('login.verify') }}">
            @csrf

            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                autofocus>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="password">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password">
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror

            <button class="btn" type="submit">Sign in</button>

            @error('login')
                <div class="error" style="margin-top:10px;">{{ $message }}</div>
            @enderror

            <div class="hint">Use a valid email & password to continue.</div>
        </form>
    </div>
</body>

</html>

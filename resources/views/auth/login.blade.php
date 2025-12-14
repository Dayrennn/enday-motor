<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
        }

        .login-card {
            max-width: 420px;
            margin: 60px auto;
            padding: 25px 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>

<body>

    <div class="login-card">
        <h3 class="text-center mb-4 fw-bold">Login</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required
                    placeholder="Masukkan email">
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required placeholder="Masukkan password">
            </div>

            <!-- Tombol Login -->
            <button type="submit" class="btn btn-primary w-100">Login</button>

            <div class="text-center mt-3">
                <small>Belum punya akun? <a href="{{ route('register') }}">Register</a></small>
                <small>Lupa Password? <a href="{{ route('password.request') }}">Lupa</a></small>
            </div>
        </form>
    </div>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
        }

        .forgot-card {
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

    <div class="forgot-card">
        <h3 class="text-center mb-4 fw-bold">Lupa Password</h3>

        <!-- Pesan Sukses -->
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <!-- Error -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Masukkan Email Anda</label>
                <input type="email" name="email" class="form-control" placeholder="Email terdaftar" required>
            </div>

            <!-- Tombol Kirim Link -->
            <button type="submit" class="btn btn-primary w-100">
                Kirim Link Reset Password
            </button>

            <div class="text-center mt-3">
                <small>
                    <a href="{{ route('login') }}">Kembali ke Login</a>
                </small>
            </div>
        </form>
    </div>

</body>

</html>

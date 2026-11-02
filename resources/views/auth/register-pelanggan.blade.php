<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Pelanggan - Sifabrik</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f0f4fd 0%, #e2eafc 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
            padding: 20px 0;
        }
        .card-register {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(26, 86, 219, 0.12);
            width: 100%;
            max-width: 480px;
        }
        .btn-primary {
            background-color: #1a56db;
            border-color: #1a56db;
        }
        .btn-primary:hover {
            background-color: #1646b5;
        }
    </style>
</head>
<body>

<div class="card card-register p-4 bg-white">
    <div class="text-center mb-4">
        <a href="{{ url('/') }}" class="text-decoration-none">
            <h3 class="fw-bold text-primary mb-1">🏭 Sifabrik</h3>
        </a>
        <p class="text-muted small">Registrasi Akun Pelanggan Baru</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger py-2 small">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('pelanggan.register.submit') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold small">Nama Lengkap / Perusahaan</label>
            <div class="input-group">
                <span class="input-group-text bg-light"><i class="fa fa-user text-muted"></i></span>
                <input type="text" name="name" class="form-control" placeholder="Contoh: PT Bangun Jaya" value="{{ old('name') }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold small">Alamat Email</label>
            <div class="input-group">
                <span class="input-group-text bg-light"><i class="fa fa-envelope text-muted"></i></span>
                <input type="email" name="email" class="form-control" placeholder="nama@email.com" value="{{ old('email') }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold small">Kata Sandi</label>
            <div class="input-group">
                <span class="input-group-text bg-light"><i class="fa fa-lock text-muted"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold small">Konfirmasi Kata Sandi</label>
            <div class="input-group">
                <span class="input-group-text bg-light"><i class="fa fa-shield-alt text-muted"></i></span>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi kata sandi" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold rounded-3 mb-3">
            <i class="fa fa-user-plus me-1"></i> Buat Akun Sekarang
        </button>
    </form>

    <div class="text-center pt-2 border-top">
        <span class="small text-muted">Sudah punya akun?</span>
        <a href="{{ route('login') }}" class="small fw-semibold text-primary text-decoration-none">Masuk di sini</a>
    </div>
</div>

</body>
</html>


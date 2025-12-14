<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MotorHub - Penjualan Motor Terpercaya</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    @vite(['resources/css/index.css'], ['resources/css/index.js'])
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-bicycle me-2"></i>EndayMotor
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#products">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Kontak</a>
                    </li>
                    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                        <a class="btn btn-primary" href="/login" target="_blank">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Temukan Motor Impian Anda</h1>
                    <p class="lead mb-4">Kami menyediakan berbagai jenis motor terbaru dengan kualitas terbaik dan harga
                        kompetitif. Dapatkan penawaran spesial untuk pembelian pertama!</p>
                    <a href="#products" class="btn btn-primary btn-lg me-2">Lihat Katalog</a>
                    <a href="#contact" class="btn btn-outline-light btn-lg">Hubungi Kami</a>
                </div>
                <div class="col-lg-6">
                    <!-- Placeholder for hero image -->
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="py-5">
        <div class="container">
            <h2 class="section-title text-center">Merk Motor</h2>
            <p class="text-center text-muted mb-5">Temukan pilihan motor terbaik dengan spesifikasi unggulan</p>

            <div class="row">
                <!-- Product 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card motor-card">
                        <div class="position-relative">
                            <img src="{{ Vite::asset('resources/images/logo-honda.png') }}" class="card-img-top"
                                alt="logo honda">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Honda</h5>
                            <p class="card-text">Motor Honda dikenal irit, tangguh, dan nyaman digunakan sehari-hari.
                                Dibekali teknologi modern dan desain stylish, Honda menjadi pilihan utama karena
                                perawatan mudah dan performa mesin yang terpercaya.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="/produk/honda" class="btn btn-primary">Lihat Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card motor-card">
                        <img src="{{ Vite::asset('resources/images/logo-yamaha.png') }}" class="card-img-top"
                            alt="logo yamaha">
                        <div class="card-body">
                            <h5 class="card-title">Yamaha</h5>
                            <p class="card-text">Motor Yamaha menawarkan performa bertenaga dengan desain sporty dan
                                teknologi modern. Dikenal responsif dan stabil, Yamaha menjadi pilihan bagi pengendara
                                yang mengutamakan gaya, kecepatan, dan kenyamanan berkendara</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="/produk/yamaha" class="btn btn-primary">Lihat Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card motor-card">
                        <img src="{{ Vite::asset('resources/images/logo-suzuki.png') }}" class="card-img-top"
                            alt="logo suzuki">
                        <div class="card-body">
                            <h5 class="card-title">Suzuki</h5>
                            <p class="card-text">Suzuki menghadirkan motor yang tangguh, irit, dan nyaman untuk berbagai
                                kebutuhan. Dengan performa stabil dan desain praktis, Suzuki menjadi pilihan pengendara
                                yang mencari motor handal dan mudah perawatan.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="/produk/suzuki" class="btn btn-primary">Lihat Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Product 4 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card motor-card">
                        <img src="{{ Vite::asset('resources/images/logo-kawasaki.png') }}" class="card-img-top"
                            alt="logo kawasaki">
                        <div class="card-body">
                            <h5 class="card-title">Kawasaki</h5>
                            <p class="card-text">Kawasaki dikenal dengan performa tinggi dan desain agresif. Dibuat
                                untuk pengendara yang menginginkan kecepatan, kekuatan, dan pengalaman berkendara yang
                                lebih sporty. Cocok untuk gaya dan adrenalin di jalanan.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="/produk/kawasaki" class="btn btn-primary">Lihat Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Product 5 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card motor-card">
                        <img src="{{ Vite::asset('resources/images/logo-vespa.jpg') }}" class="card-img-top"
                            alt="logo vespa">
                        <div class="card-body">
                            <h5 class="card-title">Vespa</h5>
                            <p class="card-text">Vespa identik dengan desain klasik yang elegan dan kenyamanan tinggi.
                                Dibuat untuk pengendara yang mengutamakan gaya, keunikan, dan pengalaman berkendara yang
                                lebih santai. Cocok untuk mobilitas perkotaan dengan sentuhan lifestyle khas Italia.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="/produk/vespa" class="btn btn-primary">Lihat Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Product 6 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card motor-card">
                        <img src="{{ Vite::asset('resources/images/logo-ktm.jpg') }}" class="card-img-top"
                            alt="logo ktm">
                        <div class="card-body">
                            <h5 class="card-title">KTM</h5>
                            <p class="card-text">KTM terkenal dengan performa agresif dan karakter mesin yang
                                bertenaga. Dirancang untuk pengendara yang menyukai tantangan, kecepatan, dan handling
                                yang responsif. Cocok untuk mereka yang menginginkan sensasi berkendara ekstrem di
                                jalanan maupun off-road.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="/produk/ktm" class="btn btn-primary">Lihat Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center">Mengapa Memilih Kami?</h2>
            <p class="text-center text-muted mb-5">Kami memberikan layanan terbaik untuk kepuasan pelanggan</p>

            <div class="row">
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="feature-box">
                        <i class="bi bi-truck feature-icon"></i>
                        <h4>Gratis Pengiriman</h4>
                        <p class="text-muted">Pengiriman gratis untuk seluruh wilayah Jabodetabek dengan jaminan aman
                            sampai tujuan.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="feature-box">
                        <i class="bi bi-shield-check feature-icon"></i>
                        <h4>Garansi Resmi</h4>
                        <p class="text-muted">Semua motor dilengkapi garansi resmi dari pabrikan dengan jaminan
                            sparepart orisinal.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="feature-box">
                        <i class="bi bi-credit-card feature-icon"></i>
                        <h4>Cicilan Mudah</h4>
                        <p class="text-muted">Bermitra dengan berbagai bank untuk memberikan kemudahan cicilan dengan
                            bunga ringan.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="feature-box">
                        <i class="bi bi-headset feature-icon"></i>
                        <h4>Layanan 24/7</h4>
                        <p class="text-muted">Tim customer service siap membantu Anda kapan saja melalui telepon, chat,
                            atau email.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5">
        <div class="container">
            <h2 class="section-title text-center">Hubungi Kami</h2>
            <p class="text-center text-muted mb-5">Kami siap membantu Anda menemukan motor impian</p>

            <div class="row">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h4 class="mb-4">Informasi Kontak</h4>
                    <div class="contact-info mb-4">
                        <p><i class="bi bi-geo-alt-fill"></i> Jl. Motor Indah No. 123, Jakarta Pusat</p>
                        <p><i class="bi bi-telephone-fill"></i> (021) 1234-5678</p>
                        <p><i class="bi bi-whatsapp"></i> +62 812-3456-7890</p>
                        <p><i class="bi bi-envelope-fill"></i> info@endaymotor.com</p>
                    </div>

                    <h4 class="mb-4">Jam Operasional</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2">Senin - Jumat: 08:00 - 17:00</li>
                        <li class="mb-2">Sabtu: 09:00 - 15:00</li>
                        <li>Minggu & Hari Libur: 10:00 - 14:00</li>
                    </ul>
                </div>

                <div class="col-lg-6">
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">No. Telepon</label>
                            <input type="tel" class="form-control" name="phone" required>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Pesan</label>
                            <textarea class="form-control" name="message" rows="4" placeholder="Tulis pesan Anda di sini..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="mb-4"><i class="bi bi-bicycle me-2"></i>MotorHub</h5>
                    <p>Dealer motor terpercaya dengan berbagai pilihan motor terbaru dari berbagai merk ternama. Kami
                        berkomitmen memberikan pelayanan terbaik untuk pelanggan.</p>
                </div>

                <div class="col-md-4 mb-4">
                    <h5 class="mb-4">Link Cepat</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#home">Beranda</a></li>
                        <li class="mb-2"><a href="#products">Produk</a></li>
                        <li class="mb-2"><a href="#features">Fitur</a></li>
                        <li><a href="#contact">Kontak</a></li>
                    </ul>
                </div>

                <div class="col-md-4 mb-4">
                    <h5 class="mb-4">Ikuti Kami</h5>
                    <div class="d-flex">
                        <a href="#" class="me-3 text-white"><i class="bi bi-facebook fs-4"></i></a>
                        <a href="#" class="me-3 text-white"><i class="bi bi-instagram fs-4"></i></a>
                        <a href="#" class="me-3 text-white"><i class="bi bi-twitter fs-4"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-youtube fs-4"></i></a>
                    </div>
                </div>
            </div>

            <hr class="mt-0 mb-4" style="border-color: #495057;">

            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2023 MotorHub. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">Designed with <i class="bi bi-heart-fill text-danger"></i> for motorcycle lovers
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="successModalLabel">Berhasil!</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    {{ session('success') }}
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>

            </div>
        </div>
    </div>


    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var modal = new bootstrap.Modal(document.getElementById('successModal'));
                modal.show();
            });
        </script>
    @endif

</body>

</html>

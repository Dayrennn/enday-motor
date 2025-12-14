<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Booking Sales - Penjualan Motor</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    @Vite(['resources/css/dashboard.css', 'resources/js/dashboard.js'])
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="sidebar-header">
                    <div class="brand-logo">
                        <i class="bi bi-bicycle"></i> <span>Enday Motor</span>
                    </div>
                </div>

                <div class="sidebar-menu">
                    <a href="{{ route('sales.dashboard') }}">
                        <i class="bi bi-speedometer2"></i> <span class="menu-text">Dashboard</span>
                    </a>
                    <a href="{{ route('sales.data-motor') }}">
                        <i class='bxr  bx-motorcycle'><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" viewBox="0 0 32 32">
                                <path fill="currentColor"
                                    d="M15 5a1 1 0 1 0 0 2h1.746a1 1 0 0 1 .9.564l1.714 3.542A3.5 3.5 0 0 0 18.5 11h-2.719a5.5 5.5 0 0 0-4.92 3.04L9.883 16H6.5a5.5 5.5 0 1 0 5.293 7h1.544a4.5 4.5 0 0 0 4.025-2.488l1.257-2.514a3.5 3.5 0 0 0 3.076-2.066l.549 1.135a5.5 5.5 0 1 0 1.8-.872l-.667-1.38c.352.12.73.185 1.123.185H27a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1h-2.5c-1.52 0-2.814.97-3.297 2.323l-1.757-3.63A3 3 0 0 0 16.746 5zm8.139 13.916l1.46 3.02a1 1 0 0 0 1.801-.872l-1.461-3.02Q25.214 18 25.5 18a3.5 3.5 0 1 1-2.361.916M3 21.5a3.5 3.5 0 1 1 7 0a3.5 3.5 0 0 1-7 0M16.382 18l-.81 1.618A2.5 2.5 0 0 1 13.338 21h-1.36a5.5 5.5 0 0 0-1.234-3zm1.598-2h-5.862l.533-1.065A3.5 3.5 0 0 1 15.78 13h2.72a1.5 1.5 0 0 1 0 3c-.173 0-.347-.004-.52 0M23 11.5a1.5 1.5 0 0 1 1.5-1.5H26v3h-1.5a1.5 1.5 0 0 1-1.5-1.5" />
                            </svg></i> <span class="menu-text">Data Motor</span>
                    </a>
                    <a href="{{ route('sales.penjualan') }}">
                        <i class="bi bi-cart-check"></i> <span class="menu-text">Penjualan</span>
                    </a>
                    <a href="{{ route('sales.booking') }}" class="active">
                        <i class="bi bi-cart-check"></i> <span class="menu-text">Booking</span>
                    </a>
                    <a href="{{ route('sales.contact') }}">
                        <i class="bi bi-people"></i> <span class="menu-text">Contact</span>
                    </a>
                </div>

                <div class="sidebar-footer" style="padding: 1rem;">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal"
                            data-bs-target="#modalLogout">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </button>

                    </form>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg navbar-custom rounded">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarToggler">
                            <h4 class="mb-0">Dashboard Penjualan Motor</h4>
                            <div class="d-flex align-items-center ms-auto">
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm dropdown-toggle d-flex align-items-center"
                                        type="button" id="userDropdown" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <img src="https://ui-avatars.com/api/?name=Admin+Motor&background=3b82f6&color=fff"
                                            alt="Admin" class="user-avatar me-2">
                                        {{ Auth::user()->name }} - {{ Auth::user()->role }}
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                        <li><a class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#modalLogout" href="#"><i
                                                    class="bi bi-box-arrow-right me-2"></i> Keluar</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Tabel Penjualan Terbaru -->
                <div class="row">
                    <div class="col-12">
                        <div class="table-container">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="fw-bold mb-0">Penjualan Terbaru</h5>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No. Booking</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Tanggal</th>
                                            <th>Motor</th>
                                            <th>Jumlah</th>
                                            <th>Uang Muka</th>
                                            <th>Catatan</th>
                                            <th>Status</th>
                                            <th>Bukti Bayar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($booking as $b)
                                            <tr>
                                                <td>{{ $b->kode_booking }}</td>
                                                <td>{{ $b->user->name }}</td>
                                                <td>{{ $b->tanggal_booking }}</td>
                                                <td>{{ $b->motor->nama_motor }}</td>
                                                <td>{{ $b->jumlah }}</td>
                                                <td>{{ number_format($b->uang_muka, 0, ',', '.') }}</td>
                                                <td>{{ $b->catatan }}</td>
                                                <td>
                                                    <!-- Dropdown Status -->
                                                    <form action="{{ route('sales.booking.updateStatus', $b->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <select name="status" class="form-select form-select-sm"
                                                            onchange="this.form.submit()">
                                                            <option value="Menunggu" @selected($b->status == 'Menunggu')>
                                                                Menunggu</option>
                                                            <option value="Aktif" @selected($b->status == 'Aktif')>Aktif
                                                            </option>
                                                            <option value="Batal" @selected($b->status == 'Batal')>Batal
                                                            </option>
                                                        </select>
                                                    </form>
                                                </td>

                                                <td>
                                                    @if ($b->bukti_pembayaran)
                                                        <a href="{{ asset('storage/' . $b->bukti_pembayaran) }}"
                                                            target="_blank" class="btn btn-sm btn-success mb-1">
                                                            <i class="bi bi-eye"></i> Lihat
                                                        </a>
                                                        <span class="badge bg-success">Sudah Upload</span>
                                                    @else
                                                        <button class="btn btn-sm btn-primary mb-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalUpload{{ $b->id }}">
                                                            <i class="bi bi-upload"></i> Upload
                                                        </button>
                                                        <span class="badge bg-danger">Belum Upload</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <!-- Tombol Hapus Booking -->
                                                    <button class="btn btn-sm btn-outline-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalHapusBooking{{ $b->id }}">
                                                        <i class="bi bi-trash"></i>
                                                    </button>

                                                    <!-- Modal Hapus Booking -->
                                                    <div class="modal fade" id="modalHapusBooking{{ $b->id }}"
                                                        tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header modal-header-custom">
                                                                    <h5 class="modal-title">Hapus Booking</h5>
                                                                    <button type="button"
                                                                        class="btn-close btn-close-white"
                                                                        data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Apakah Anda yakin ingin menghapus booking motor
                                                                        <strong>{{ $b->nama_motor }}</strong> dengan
                                                                        kode booking
                                                                        <strong>{{ $b->kode_booking }}</strong>?
                                                                    </p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form
                                                                        action="{{ route('sales.booking.destroy', $b->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="button"
                                                                            class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Batal</button>
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Hapus
                                                                            Booking</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal Upload Bukti Bayar -->
                                                    <div class="modal fade" id="modalUpload{{ $b->id }}"
                                                        tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header modal-header-custom">
                                                                    <h5 class="modal-title">Upload Bukti Pembayaran
                                                                    </h5>
                                                                    <button type="button"
                                                                        class="btn-close btn-close-white"
                                                                        data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('booking.uploadBukti', $b->id) }}"
                                                                        method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Pilih File
                                                                                Bukti</label>
                                                                            <input type="file" class="form-control"
                                                                                name="bukti_pembayaran"
                                                                                accept="image/*,application/pdf"
                                                                                required>
                                                                            <small class="text-muted">Format: JPG, PNG,
                                                                                PDF. Maks 2MB</small>
                                                                        </div>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Upload</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Pagination -->
                                <div class="mt-3">
                                    {{ $booking->links() }}
                                </div>

                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="d-flex justify-content-end mt-3">
                                    {{ $booking->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalLogout" tabindex="-1" aria-labelledby="modalLogoutLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header bg-primary text-white">
                    <h1 class="modal-title fs-5" id="modalLogoutLabel">Konfirmasi Logout</h1>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body text-center">
                    <p class="mb-0">Apakah Anda yakin ingin keluar?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            Ya, Keluar
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>

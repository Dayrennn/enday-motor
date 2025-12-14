<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelanggan - MotorHub</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    @Vite(['resources/css/pelanggan.css', 'resources/js/pelanggan.js'])
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-primary" href="#">
                <i class="bi bi-bicycle me-2"></i>Enday Motor
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="bi bi-speedometer2 me-1"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#data-motor"><i class="bi bi-motorcycle me-1"></i> Data Motor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#booking"><i class="bi bi-calendar-check me-1"></i> Booking</a>
                    </li>

                </ul>
                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle d-flex align-items-center" type="button"
                            data-bs-toggle="dropdown">
                            <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=3b82f6&color=fff"
                                alt="User" class="rounded-circle me-2" width="32" height="32">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> Profil</a>
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i> Pengaturan</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalLogout"
                                    href="#"><i class="bi bi-box-arrow-right me-2"></i> Keluar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header & Statistik -->
    <div class="page-header">
        <div class="container">
            <h1 class="fw-bold">Halaman Pelanggan</h1>
            <p class="mb-0">Kelola data motor, booking, kredit, dan pembelian Anda</p>
        </div>
    </div>

    <div class="container">
        <!-- Tab Navigasi -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="data-motor-tab" data-bs-toggle="tab" data-bs-target="#data-motor"
                    type="button">
                    <i class="bi bi-motorcycle me-1"></i> Data Motor
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="booking-tab" data-bs-toggle="tab" data-bs-target="#booking" type="button">
                    <i class="bi bi-calendar-check me-1"></i> Booking
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pembelian-tab" data-bs-toggle="tab" data-bs-target="#pembelian"
                    type="button">
                    <i class="bi bi-cart-check me-1"></i> Pembelian
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="myTabContent">
            <!-- Tab Data Motor -->
            <div class="tab-pane fade show active" id="data-motor" role="tabpanel">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="fw-bold">Data Motor Tersedia</h4>
                    <div class="d-flex">
                        <select class="form-select me-2" style="width: auto;">
                            <option selected>Semua Merk</option>
                            <option>Honda</option>
                            <option>Yamaha</option>
                            <option>Suzuki</option>
                            <option>Kawasaki</option>
                        </select>
                        <input type="text" class="form-control" placeholder="Cari motor..."
                            style="width: 250px;">
                    </div>
                </div>

                <div class="row">
                    <!-- Data Motor -->
                    @foreach ($motors as $motor)
                        <div class="col-md-4">
                            <div class="card card-custom h-100">
                                <img src="{{ $motor->images ? asset('storage/' . $motor->images) : asset('default.jpg') }}"
                                    class="card-img-top" alt="{{ $motor->nama_motor }}">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title fw-bold">{{ $motor->nama_motor }}</h5>
                                        @if ($motor->diskon)
                                            <span class="badge bg-success">Hemat {{ $motor->diskon }}%</span>
                                        @endif
                                    </div>
                                    <p class="text-muted">{{ $motor->caption }}</p>
                                    <div class="mb-3">
                                        <small class="d-block"><i class="bi bi-fuel-pump me-1"></i>
                                            {{ $motor->spesifikasi }}</small>
                                    </div>
                                    @if ($motor->diskon)
                                        <span class="price-tag text-danger fw-bold">Rp
                                            {{ number_format($motor->harga_setelah_diskon, 0, ',', '.') }}</span>
                                        <del class="text-muted">Rp
                                            {{ number_format($motor->harga_awal, 0, ',', '.') }}</del>
                                    @else
                                        <span class="price-tag fw-bold">Rp
                                            {{ number_format($motor->harga_awal, 0, ',', '.') }}</span>
                                    @endif
                                    <div class="d-flex mt-3">
                                        <button class="btn btn-success btn-sm action-btn" data-bs-toggle="modal"
                                            data-bs-target="#bookingModal{{ $motor->id }}">
                                            <i class="bi bi-calendar-check me-1"></i> Booking
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Tab Booking -->
            <div class="tab-pane fade" id="booking" role="tabpanel">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="fw-bold">Riwayat Booking Motor</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover" id="bookingTable">
                        <thead>
                            <tr>
                                <th>No. Booking</th>
                                <th>Nama Pelanggan</th>
                                <th>Tanggal</th>
                                <th>Motor</th>
                                <th>Junlah</th>
                                <th>Uang Muka</th>
                                <th>Catatan</th>
                                <th>Status</th>
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
                                    <td>{{ $b->uang_muka }}</td>
                                    <td>{{ $b->catatan }}</td>
                                    <td>
                                        @if ($b->status == 'Aktif')
                                            <span class="badge bg-success bg-opacity-25 text-success">Aktif</span>
                                        @elseif ($b->status == 'Menunggu')
                                            <span class="badge bg-warning bg-opacity-25 text-warning">Menunggu</span>
                                        @else
                                            <span class="badge bg-danger bg-opacity-25 text-danger">Batal</span>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Tombol Hapus -->
                                        <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalHapusBooking{{ $b->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                        <!-- Tombol Upload Bukti -->
                                        @if (!$b->bukti_pembayaran)
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#modalUpload{{ $b->id }}">
                                                <i class="bi bi-upload"></i> Upload
                                            </button>
                                        @else
                                            <a href="{{ asset('storage/' . $b->bukti_pembayaran) }}" target="_blank"
                                                class="btn btn-sm btn-success">
                                                <i class="bi bi-check-circle"></i> Lihat
                                            </a>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tab Pembelian -->
            <div class="tab-pane fade" id="pembelian" role="tabpanel">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="fw-bold">Riwayat Pembelian Motor</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID Transaksi</th>
                                <th>Tanggal</th>
                                <th>Nama Pelanggan</th>
                                <th>Motor</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($penjualan as $p)
                                <tr>
                                    <td>{{ $p->kode_transaksi }}</td>
                                    <td>{{ $p->tanggal }}</td>
                                    <td>{{ $p->pelanggan->name ?? '-' }}</td>
                                    <td>{{ $p->motor->merk_motor }} - {{ $p->motor->nama_motor }}</td>
                                    <td>{{ $p->jumlah }}</td>
                                    <td>Rp {{ number_format($p->total) }}</td>

                                    <td>
                                        @if ($p->status == 'pending')
                                            <span
                                                class="badge-status bg-danger bg-opacity-10 text-danger">Pending</span>
                                        @elseif ($p->status == 'dp')
                                            <span class="badge-status bg-info bg-opacity-10 text-info">DP
                                                20%</span>
                                        @elseif($p->status == 'diproses')
                                            <span
                                                class="badge-status bg-warning bg-opacity-10 text-warning">Diproses</span>
                                        @elseif($p->status == 'selesai')
                                            <span
                                                class="badge-status bg-success bg-opacity-10 text-success">Selesai</span>
                                        @elseif($p->status == 'batal')
                                            <span
                                                class="badge-status bg-secondary bg-opacity-10 text-secondary">Batal</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada data penjualan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="d-flex justify-content-end mt-3">
                        {{ $penjualan->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>


        <!-- modal logout -->
        <div class="modal fade" id="modalLogout" tabindex="-1" aria-labelledby="modalLogoutLabel"
            aria-hidden="true">
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
        <!--upload bukti bayar-->
        @foreach ($booking as $b)
            <div class="modal fade" id="modalUpload{{ $b->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header modal-header-custom">
                            <h5 class="modal-title">Upload Bukti Pembayaran</h5>
                            <button type="button" class="btn-close btn-close-white"
                                data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('booking.uploadBukti', $b->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="bukti_pembayaran" class="form-label">Pilih File Bukti</label>
                                    <input type="file" class="form-control" name="bukti_pembayaran"
                                        accept="image/*,application/pdf" required>
                                    <small class="text-muted">Format: JPG, PNG, PDF. Maks 2MB</small>
                                </div>

                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @foreach ($motors as $motor)
            <!-- Modal Booking -->
            <div class="modal fade" id="bookingModal{{ $motor->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header modal-header-custom">
                            <h5 class="modal-title">Booking Motor</h5>
                            <button type="button" class="btn-close btn-close-white"
                                data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">

                            <form id="bookingForm{{ $motor->id }}" action="{{ route('booking.store') }}"
                                method="POST">
                                @csrf

                                <input type="hidden" name="motor_id" value="{{ $motor->id }}">

                                <input type="hidden" name="kode_booking" value="BK-{{ rand(1000, 9999) }}">

                                <div class="mb-3">
                                    <label class="form-label">Nama Motor</label>
                                    <select class="form-select" name="nama_motor" required>
                                        <option selected>
                                            {{ $motor->nama_motor }} - Rp
                                            {{ number_format($motor->harga_setelah_diskon ?? $motor->harga_awal, 0, ',', '.') }}
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Jumlah</label>
                                    <input type="number" class="form-control jumlah-input" name="jumlah"
                                        value="1" required>
                                </div>


                                <div class="mb-3">
                                    <label class="form-label">Tanggal Booking</label>
                                    <input type="date" class="form-control" name="tanggal_booking"
                                        value="{{ date('Y-m-d') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Uang Muka (DP) 20%</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>

                                        <input type="number" class="form-control dp-input" name="uang_muka"
                                            data-harga="{{ $motor->harga_setelah_diskon ?? $motor->harga_awal }}"
                                            readonly>
                                    </div>
                                    <small class="text-muted">DP otomatis 20% dari harga motor</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Catatan (Opsional)</label>
                                    <textarea class="form-control" name="catatan" rows="3" placeholder="Tambahkan catatan jika diperlukan"></textarea>
                                </div>
                            </form>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" form="bookingForm{{ $motor->id }}" class="btn btn-primary">
                                Simpan Booking
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @foreach ($booking as $b)
            <!-- Modal Hapus Booking -->
            <div class="modal fade" id="modalHapusBooking{{ $b->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header modal-header-custom">
                            <h5 class="modal-title">Hapus Booking</h5>
                            <button type="button" class="btn-close btn-close-white"
                                data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus booking motor <strong>{{ $b->nama_motor }}</strong>
                                dengan
                                kode booking <strong>{{ $b->kode_booking }}</strong>?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('booking.destroy', $b->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger">Hapus Booking</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach


        <!-- Modal Kredit -->
        <div class="modal fade" id="kreditModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-custom">
                        <h5 class="modal-title">Pengajuan Kredit Motor</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="kreditForm">
                            <div class="mb-3">
                                <label class="form-label">Pilih Motor</label>
                                <select class="form-select" required>
                                    <option value="">-- Pilih Motor --</option>
                                    <option selected>Honda Beat - Biru - Rp 18.500.000</option>
                                    <option>Yamaha NMAX - Hitam - Rp 28.500.000</option>
                                    <option>Suzuki GSX-R150 - Merah - Rp 33.200.000</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pilih Tenor</label>
                                <select class="form-select" required>
                                    <option value="">-- Pilih Tenor --</option>
                                    <option>6 Bulan</option>
                                    <option>12 Bulan</option>
                                    <option selected>24 Bulan</option>
                                    <option>36 Bulan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Uang Muka</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" placeholder="Jumlah DP"
                                        value="5000000" required>
                                </div>
                                <small class="text-muted">Minimal DP: 20% dari harga motor</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Penghasilan Per Bulan</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" placeholder="Penghasilan bulanan"
                                        required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pekerjaan</label>
                                <input type="text" class="form-control" placeholder="Pekerjaan Anda" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" form="kreditForm" class="btn btn-primary">Ajukan Kredit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>


</body>

</html>

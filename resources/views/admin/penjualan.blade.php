<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan Admin - Penjualan Motor</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2"></i> <span class="menu-text">Dashboard</span>
                    </a>
                    <a href="{{ route('admin.data-motor') }}">
                        <i class='bxr  bx-motorcycle'><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" viewBox="0 0 32 32">
                                <path fill="currentColor"
                                    d="M15 5a1 1 0 1 0 0 2h1.746a1 1 0 0 1 .9.564l1.714 3.542A3.5 3.5 0 0 0 18.5 11h-2.719a5.5 5.5 0 0 0-4.92 3.04L9.883 16H6.5a5.5 5.5 0 1 0 5.293 7h1.544a4.5 4.5 0 0 0 4.025-2.488l1.257-2.514a3.5 3.5 0 0 0 3.076-2.066l.549 1.135a5.5 5.5 0 1 0 1.8-.872l-.667-1.38c.352.12.73.185 1.123.185H27a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1h-2.5c-1.52 0-2.814.97-3.297 2.323l-1.757-3.63A3 3 0 0 0 16.746 5zm8.139 13.916l1.46 3.02a1 1 0 0 0 1.801-.872l-1.461-3.02Q25.214 18 25.5 18a3.5 3.5 0 1 1-2.361.916M3 21.5a3.5 3.5 0 1 1 7 0a3.5 3.5 0 0 1-7 0M16.382 18l-.81 1.618A2.5 2.5 0 0 1 13.338 21h-1.36a5.5 5.5 0 0 0-1.234-3zm1.598-2h-5.862l.533-1.065A3.5 3.5 0 0 1 15.78 13h2.72a1.5 1.5 0 0 1 0 3c-.173 0-.347-.004-.52 0M23 11.5a1.5 1.5 0 0 1 1.5-1.5H26v3h-1.5a1.5 1.5 0 0 1-1.5-1.5" />
                            </svg></i> <span class="menu-text">Data Motor</span>
                    </a>
                    <a href="{{ route('admin.penjualan') }}" class="active">
                        <i class="bi bi-cart-check"></i> <span class="menu-text">Penjualan</span>
                    </a>
                    <a href="{{ route('admin.booking') }}">
                        <i class="bi bi-cart-check"></i> <span class="menu-text">Booking</span>
                    </a>
                    <a href="{{ route('admin.contact') }}">
                        <i class="bi bi-people"></i> <span class="menu-text">Contact</span>
                    </a>
                    <a href="{{ route('admin.user') }}">
                        <i class="bi bi-people"></i> <span class="menu-text">User</span>
                    </a>
                </div>

                <!-- Footer dengan Logout - Versi Minimalis -->
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
                                <button class="btn btn-primary-custom btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalTambahPenjualan">
                                    <i class="bi bi-plus-circle me-1"></i> Tambah Penjualan
                                </button>
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
                                            <th>Aksi</th>
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

                                                <td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalEditPenjualan{{ $p->id }}">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>

                                                    <button class="btn btn-sm btn-outline-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalHapusPenjualan{{ $p->id }}">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </td>
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
                </div>
            </main>
        </div>
    </div>

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

    <!-- Modal Tambah Penjualan -->
    <div class="modal fade" id="modalTambahPenjualan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.penjualan.store') }}" method="POST">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Penjualan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <!-- Kode Transaksi (otomatis) -->
                        <input type="hidden" name="kode_transaksi" value="{{ date('y') . rand(10000, 99999) }}">

                        <!-- Tanggal otomatis -->
                        <input type="hidden" name="tanggal" value="{{ date('Y-m-d H:i:s') }}">


                        <!-- Motor -->
                        <div class="mb-3">
                            <label class="form-label">Motor</label>
                            <select name="motor_id" class="form-control" required>
                                <option value="">-- Pilih Motor --</option>
                                @foreach ($motor as $m)
                                    <option value="{{ $m->id }}">
                                        {{ $m->merk_motor }} - {{ $m->nama_motor }} (Rp
                                        {{ number_format($m->harga_setelah_diskon) }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Pelanggan -->
                        <div class="mb-3">
                            <label class="form-label">Pelanggan</label>
                            <select name="pelanggan_id" class="form-control select2" required>
                                <option value="">-- Pilih Pelanggan --</option>
                                @foreach ($pelanggan as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <!-- Jumlah -->
                        <div class="mb-3">
                            <label class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" required min="1">
                        </div>

                        <!-- Total -->
                        <div class="mb-3">
                            <label class="form-label">Total</label>
                            <input type="number" name="total" class="form-control">
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="pending">Pending</option>
                                <option value="dp">DP 20%</option>
                                <option value="diproses">Diproses</option>
                                <option value="selesai">Selesai</option>
                                <option value="batal">Batal</option>
                            </select>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
    @foreach ($penjualan as $p)
        <!-- Modal Edit Penjualan -->
        <div class="modal fade" id="modalEditPenjualan{{ $p->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('admin.penjualan.update', $p->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Penjualan ({{ $p->kode_transaksi }})</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" name="tanggal" value="{{ $p->tanggal }}">

                            <div class="mb-3">
                                <label class="form-label">Pelanggan</label>
                                <select name="pelanggan_id" class="form-control select2-edit"
                                    data-id="{{ $p->id }}" required>
                                    <option value="">-- Pilih Pelanggan --</option>
                                    @foreach ($pelanggan as $pl)
                                        <option value="{{ $pl->id }}"
                                            {{ $pl->id == $p->pelanggan_id ? 'selected' : '' }}>
                                            {{ $pl->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('pelanggan_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Motor</label>
                                <select name="motor_id" class="form-control motor-select-edit"
                                    data-id="{{ $p->id }}" required>
                                    <option value="">-- Pilih Motor --</option>
                                    @foreach ($motor as $m)
                                        <option value="{{ $m->id }}"
                                            data-harga="{{ $m->harga_setelah_diskon }}"
                                            {{ $m->id == $p->motor_id ? 'selected' : '' }}>
                                            {{ $m->merk_motor }} - {{ $m->nama_motor }} (Rp
                                            {{ number_format($m->harga_setelah_diskon) }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('motor_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Harga Satuan</label>
                                <input type="text" class="form-control"
                                    id="harga-satuan-display-{{ $p->id }}" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jumlah</label>
                                <input type="number" name="jumlah" class="form-control jumlah-input-edit"
                                    data-id="{{ $p->id }}" required min="1"
                                    value="{{ $p->jumlah }}">
                                @error('jumlah')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Total Penjualan</label>
                                <input type="text" class="form-control" id="total-display-{{ $p->id }}"
                                    disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="pending" {{ $p->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="dp" {{ $p->status == 'dp' ? 'selected' : '' }}>DP 20%
                                    </option>
                                    <option value="diproses" {{ $p->status == 'diproses' ? 'selected' : '' }}>Diproses
                                    </option>
                                    <option value="selesai" {{ $p->status == 'selesai' ? 'selected' : '' }}>Selesai
                                    </option>
                                    <option value="batal" {{ $p->status == 'batal' ? 'selected' : '' }}>Batal
                                    </option>
                                </select>
                                @error('status')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach


    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        // Fungsi untuk memformat angka menjadi Rupiah (misalnya: 12.345.678)
        function formatRupiah(angka) {
            var reverse = angka.toString().split('').reverse().join(''),
                ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');
            return ribuan;
        }

        // Fungsi utama untuk menghitung dan memperbarui total pada modal EDIT
        function hitungTotalEdit(id) {
            const modal = $('#modalEditPenjualan' + id);

            // Dapatkan elemen
            const motorSelect = modal.find('.motor-select-edit[data-id="' + id + '"]');
            const jumlahInput = modal.find('.jumlah-input-edit[data-id="' + id + '"]');
            const hargaDisplay = modal.find('#harga-satuan-display-' + id);
            const totalDisplay = modal.find('#total-display-' + id);

            // Ambil nilai
            const selectedOption = motorSelect.find('option:selected');
            const harga = selectedOption.data('harga') || 0; // Ambil harga dari data-attribute
            const jumlah = parseInt(jumlahInput.val()) || 0;

            const totalBaru = harga * jumlah;

            // Perbarui tampilan
            hargaDisplay.val('Rp ' + formatRupiah(harga));
            totalDisplay.val('Rp ' + formatRupiah(totalBaru));
        }


        $(document).ready(function() {
            // 1. Inisialisasi Select2 untuk Modal TAMBAH
            $('#modalTambahPenjualan').find('.select2').select2({
                dropdownParent: $('#modalTambahPenjualan'),
                width: '100%',
                placeholder: '-- Pilih Pelanggan --'
            });

            // 2. Inisialisasi dan Listeners untuk Modal EDIT
            $('[id^="modalEditPenjualan"]').each(function() {
                const modalElement = $(this);
                const id = modalElement.attr('id').split('modalEditPenjualan')[1];

                // Inisialisasi Select2 untuk Pelanggan di Modal Edit saat ditampilkan
                modalElement.on('shown.bs.modal', function() {
                    modalElement.find('.select2-edit').select2({
                        dropdownParent: modalElement,
                        width: '100%',
                        placeholder: '-- Pilih Pelanggan --'
                    });

                    // Panggil perhitungan Total dan Harga awal saat modal dibuka
                    hitungTotalEdit(id);
                });

                // Hancurkan Select2 saat modal ditutup
                modalElement.on('hidden.bs.modal', function() {
                    modalElement.find('.select2-edit').select2('destroy');
                });

                // Dengarkan perubahan pada Motor atau Jumlah di modal edit ini
                modalElement.on('change', '.motor-select-edit[data-id="' + id +
                    '"], .jumlah-input-edit[data-id="' + id + '"]',
                    function() {
                        hitungTotalEdit(id);
                    });

                // Pastikan perubahan jumlah via tombol spinner juga memicu perubahan
                modalElement.on('input', '.jumlah-input-edit[data-id="' + id + '"]', function() {
                    hitungTotalEdit(id);
                });
            });
        });
    </script>
</body>

</html>

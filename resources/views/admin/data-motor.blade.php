<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Motor Admin - Penjualan Motor</title>
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
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2"></i> <span class="menu-text">Dashboard</span>
                    </a>
                    <a href="{{ route('admin.data-motor') }}" class="active">
                        <i class='bxr  bx-motorcycle'><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" viewBox="0 0 32 32">
                                <path fill="currentColor"
                                    d="M15 5a1 1 0 1 0 0 2h1.746a1 1 0 0 1 .9.564l1.714 3.542A3.5 3.5 0 0 0 18.5 11h-2.719a5.5 5.5 0 0 0-4.92 3.04L9.883 16H6.5a5.5 5.5 0 1 0 5.293 7h1.544a4.5 4.5 0 0 0 4.025-2.488l1.257-2.514a3.5 3.5 0 0 0 3.076-2.066l.549 1.135a5.5 5.5 0 1 0 1.8-.872l-.667-1.38c.352.12.73.185 1.123.185H27a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1h-2.5c-1.52 0-2.814.97-3.297 2.323l-1.757-3.63A3 3 0 0 0 16.746 5zm8.139 13.916l1.46 3.02a1 1 0 0 0 1.801-.872l-1.461-3.02Q25.214 18 25.5 18a3.5 3.5 0 1 1-2.361.916M3 21.5a3.5 3.5 0 1 1 7 0a3.5 3.5 0 0 1-7 0M16.382 18l-.81 1.618A2.5 2.5 0 0 1 13.338 21h-1.36a5.5 5.5 0 0 0-1.234-3zm1.598-2h-5.862l.533-1.065A3.5 3.5 0 0 1 15.78 13h2.72a1.5 1.5 0 0 1 0 3c-.173 0-.347-.004-.52 0M23 11.5a1.5 1.5 0 0 1 1.5-1.5H26v3h-1.5a1.5 1.5 0 0 1-1.5-1.5" />
                            </svg></i> <span class="menu-text">Data Motor</span>
                    </a>
                    <a href="{{ route('admin.penjualan') }}">
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

                <!-- Footer dengan Logout -->
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


                <div class="row">
                    <div class="col-12">
                        <div class="table-container">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="d-flex justify-content-between align-items-center mb-3">

                                <h4 class="fw-bold">Data Motor</h4>
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalTambahMerek">
                                    <i class="bi bi-plus-circle"></i> Tambah Merek
                                </button>

                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Motor</th>
                                            <th>Merk</th>
                                            <th>Gambar Motor</th>
                                            <th>Caption</th>
                                            <th>Spesifikasi</th>
                                            <th>Deskripsi</th>
                                            <th>Harga Awal</th>
                                            <th>Diskon</th>
                                            <th>Harga Diskon</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_motor as $motor)
                                            <tr>
                                                <td>{{ $motor->id }}</td>
                                                <td>{{ $motor->nama_motor }}</td>
                                                <td>{{ $motor->merk_motor }}</td>
                                                <td>
                                                    <img src="{{ $motor->images ? asset('storage/' . $motor->images) : asset('default.jpg') }}"
                                                        alt="{{ $motor->nama_motor }}"
                                                        style="width: 100px; height: auto;">
                                                </td>
                                                <td>{{ $motor->caption }}</td>
                                                <td>{{ $motor->spesifikasi }}</td>
                                                <td>{{ $motor->description }}</td>
                                                <td>{{ $motor->harga_awal }}</td>
                                                <td>{{ $motor->diskon }}</td>
                                                <td>{{ $motor->harga_setelah_diskon }}</td>
                                                <td>{{ $motor->created_at->format('d M Y') }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalEditMotor{{ $motor->id }}">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>

                                                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                                        data-bs-target="#modalHapusMotor{{ $motor->id }}">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="d-flex justify-content-end mt-3">
                                    {{ $data_motor->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <!-- Modal Logout -->
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


    <!-- Modal Tambah Motor -->
    <div class="modal fade" id="modalTambahMerek" tabindex="-1" aria-labelledby="modalTambahMerekLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahMerekLabel">Tambah Merek</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.data-motor.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Nama Motor</label>
                            <input type="text" name="nama_motor" class="form-control" required>
                        </div>

                        <div class="col-auto">
                            <label class="visually-hidden" for="autoSizingSelect">Preference</label>
                            <select class="form-select" id="merk_motor" name="merk_motor" required>
                                <option selected>Pilih</option>
                                <option value="honda">Honda</option>
                                <option value="yamaha">Yamaha</option>
                                <option value="suzuki">Suzuki</option>
                                <option value="kawasaki">Kawasaki</option>
                                <option value="vespa">Vespa</option>
                                <option value="ktm">KTM</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tambah Gambar</label>
                            <input type="file" name="images" class="form-control" accept="image/*" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Caption</label>
                            <input type="text" name="caption" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Spesifikasi</label>
                            <textarea type="textarea" name="spesifikasi" class="form-control" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="3" required></textarea>
                        </div>

                        <!-- Harga Awal -->
                        <div class="mb-3">
                            <label class="form-label">Harga Awal</label>
                            <input type="number" id="harga_awal" name="harga_awal" class="form-control" required>
                        </div>

                        <!-- Diskon (%) -->
                        <div class="mb-3">
                            <label class="form-label">Diskon (%)</label>
                            <input type="number" id="diskon" name="diskon" class="form-control"
                                placeholder="Isi jika ada">
                        </div>

                        <!-- Harga Setelah Diskon -->
                        <div class="mb-3">
                            <label class="form-label">Harga Setelah Diskon</label>
                            <input type="number" id="harga_setelah_diskon" name="harga_setelah_diskon"
                                class="form-control" readonly>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @foreach ($data_motor as $motor)
        <div class="modal fade" id="modalEditMotor{{ $motor->id }}" ...>
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('admin.data-motor.update', $motor->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">

                            <div class="mb-3">
                                <label class="form-label">Nama Motor</label>
                                <input type="text" name="nama_motor" class="form-control"
                                    value="{{ $motor->nama_motor }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Merk Motor</label>
                                <select name="merk_motor" class="form-select" required>
                                    <option value="" disabled>Pilih Merek</option>
                                    <option value="Honda" @selected($motor->merk_motor == 'Honda')>Honda</option>
                                    <option value="Yamaha" @selected($motor->merk_motor == 'Yamaha')>Yamaha</option>
                                    <option value="Suzuki" @selected($motor->merk_motor == 'Suzuki')>Suzuki</option>
                                    <option value="Kawasaki" @selected($motor->merk_motor == 'Kawasaki')>Kawasaki</option>
                                    <option value="Vespa" @selected($motor->merk_motor == 'Vespa')>Vespa</option>
                                    <option value="KTM" @selected($motor->merk_motor == 'KTM')>KTM</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Gambar Saat Ini</label>
                                @if ($motor->images)
                                    <img src="{{ asset('storage/' . $motor->images) }}"
                                        alt="{{ $motor->nama_motor }}"
                                        style="max-width: 150px; display: block; margin-bottom: 10px;">
                                @else
                                    <p>Tidak ada gambar.</p>
                                @endif
                                <label class="form-label">Ganti Gambar (Opsional)</label>
                                <input type="file" name="images" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Caption</label>
                                <input type="text" name="caption" class="form-control" required
                                    value="{{ $motor->caption }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Spesifikasi</label>
                                <textarea name="spesifikasi" class="form-control" rows="3">{{ $motor->spesifikasi }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="description" class="form-control" rows="3">{{ $motor->description }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Harga Awal</label>
                                <input type="number" id="harga_awal_edit_{{ $motor->id }}" name="harga_awal"
                                    class="form-control" value="{{ $motor->harga_awal }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Diskon (%)</label>
                                <input type="number" id="diskon_edit_{{ $motor->id }}" name="diskon"
                                    class="form-control" placeholder="Isi jika ada" value="{{ $motor->diskon }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Harga Setelah Diskon</label>
                                <input type="hidden" name="harga_setelah_diskon"
                                    id="harga_setelah_diskon_hidden_{{ $motor->id }}">
                                <input type="number" id="harga_setelah_diskon_edit_{{ $motor->id }}"
                                    class="form-control" value="{{ $motor->harga_setelah_diskon }}" readonly
                                    oninput="document.getElementById('harga_setelah_diskon_hidden_{{ $motor->id }}').value = this.value;">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal hapus motor -->
        <div class="modal fade" id="modalHapusMotor{{ $motor->id }}" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalHapusMotorLabel{{ $motor->id }}"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form action="{{ route('admin.data-motor.destroy', $motor->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="modalHapusMotorLabel{{ $motor->id }}">Konfirmasi Hapus
                                Motor
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus motor <strong>{{ $motor->nama_motor }}</strong>?
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
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
    <script>
        // Panggil fungsi untuk modal Tambah
        kalkulasiDiskon('harga_awal', 'diskon', 'harga_setelah_diskon');

        // Panggil fungsi untuk semua modal Edit (Menggunakan loop Blade)
        @foreach ($data_motor as $motor)
            kalkulasiDiskon('harga_awal{{ $motor->id }}', 'diskon{{ $motor->id }}',
                'harga_setelah_diskon{{ $motor->id }}');
        @endforeach
    </script>
</body>

</html>

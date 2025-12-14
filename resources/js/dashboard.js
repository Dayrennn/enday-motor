// Chart Penjualan
// Chart Penjualan dengan data dari server
document.addEventListener("DOMContentLoaded", function () {
    const salesChartEl = document.getElementById("salesChart");
    if (!salesChartEl) return;

    fetch("/admin/chart-data")
        .then((res) => res.json())
        .then((data) => {
            const chart = new Chart(salesChartEl.getContext("2d"), {
                type: "line",
                data: {
                    labels: data.labels,
                    datasets: [
                        {
                            label: "Jumlah Unit Terjual",
                            data: data.unitData,
                            backgroundColor: "rgba(59, 130, 246, 0.1)",
                            borderColor: "rgba(59, 130, 246, 1)",
                            borderWidth: 3,
                            tension: 0.4,
                            fill: true,
                        },
                        {
                            label: "Pendapatan (dalam juta)",
                            data: data.revenueData,
                            backgroundColor: "rgba(16, 185, 129, 0.1)",
                            borderColor: "rgba(16, 185, 129, 1)",
                            borderWidth: 3,
                            tension: 0.4,
                            fill: true,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: { beginAtZero: true },
                    },
                },
            });
        })
        .catch((err) => console.error("Gagal mengambil data chart:", err));
});

// Toggle sidebar di mobile
document.addEventListener("DOMContentLoaded", function () {
    const sidebarToggle = document.querySelector(".navbar-toggler");
    const sidebar = document.querySelector(".sidebar");

    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener("click", function () {
            sidebar.classList.toggle("d-none");
            sidebar.classList.toggle("d-block");
        });
    }

    // Aktifkan menu sidebar
    const menuItems = document.querySelectorAll(".sidebar-menu a");
    menuItems.forEach((item) => {
        item.addEventListener("click", function () {
            menuItems.forEach((i) => i.classList.remove("active"));
            this.classList.add("active");

            // Di perangkat mobile, sembunyikan sidebar setelah memilih menu
            if (window.innerWidth < 768) {
                sidebar.classList.add("d-none");
                sidebar.classList.remove("d-block");
            }
        });
    });
});

function kalkulasiDiskon(hargaAwalId, diskonId, hargaSetelahDiskonId) {
    const hargaAwal = document.getElementById(hargaAwalId);
    const diskon = document.getElementById(diskonId);
    const hargaSetelahDiskon = document.getElementById(hargaSetelahDiskonId);

    if (hargaAwal && diskon && hargaSetelahDiskon) {
        const hitung = () => {
            let h = parseFloat(hargaAwal.value) || 0;
            let d = parseFloat(diskon.value) || 0;

            // Pastikan diskon tidak lebih dari 100%
            if (d > 100) {
                d = 100;
                diskon.value = 100;
            }

            // Rumus perhitungan diskon dan dibulatkan
            hargaSetelahDiskon.value = (h - (h * d) / 100).toFixed(0);
        };

        // Tambahkan event listener saat nilai input berubah
        hargaAwal.addEventListener("input", hitung);
        diskon.addEventListener("input", hitung);

        // Panggil hitung() saat fungsi dipanggil (penting untuk nilai awal di modal Edit)
        hitung();
    }
}
// Inisialisasi kalkulasi diskon untuk form tambah motor
kalkulasiDiskon("harga_awal", "diskon", "harga_setelah_diskon");

// Inisialisasi kalkulasi diskon untuk setiap form edit motor
document.querySelectorAll(".edit-motor-form").forEach((form) => {
    const motorId = form.dataset.motorId;
    kalkulasiDiskon(
        `harga_awal${motorId}`,
        `diskon${motorId}`,
        `harga_setelah_diskon${motorId}`
    );
});

// ====================================================================
// LOGIKA PENJUALAN - SELECT2 DAN PERHITUNGAN TOTAL (BARU - Membutuhkan jQuery)
// ====================================================================

// Fungsi untuk memformat angka menjadi Rupiah (misalnya: 12.345.678)
function formatRupiah(angka) {
    var reverse = angka.toString().split("").reverse().join(""),
        ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join(".").split("").reverse().join("");
    return ribuan;
}

// Fungsi utama untuk menghitung dan memperbarui total pada modal EDIT
function hitungTotalEdit(id) {
    // Pastikan jQuery sudah dimuat
    if (typeof jQuery === "undefined") {
        console.error("jQuery is not loaded. Cannot run hitungTotalEdit.");
        return;
    }

    const modal = $("#modalEditPenjualan" + id);

    // Dapatkan elemen
    const motorSelect = modal.find('.motor-select-edit[data-id="' + id + '"]');
    const jumlahInput = modal.find('.jumlah-input-edit[data-id="' + id + '"]');
    const hargaDisplay = modal.find("#harga-satuan-display-" + id);
    const totalDisplay = modal.find("#total-display-" + id);

    // Ambil nilai
    const selectedOption = motorSelect.find("option:selected");
    // Ambil harga dari data-attribute
    const harga = selectedOption.length ? selectedOption.data("harga") || 0 : 0;
    const jumlah = parseInt(jumlahInput.val()) || 0;

    const totalBaru = harga * jumlah;

    // Perbarui tampilan
    hargaDisplay.val("Rp " + formatRupiah(harga));
    totalDisplay.val("Rp " + formatRupiah(totalBaru));
}

$(document).ready(function () {
    // 1. Inisialisasi Select2 untuk Modal TAMBAH
    // Menggunakan kelas umum .select2 (sesuai template Anda)
    $("#modalTambahPenjualan")
        .find(".select2")
        .select2({
            dropdownParent: $("#modalTambahPenjualan"),
            width: "100%",
            placeholder: "-- Pilih Pelanggan --",
        });

    // 2. Inisialisasi dan Listeners untuk Modal EDIT
    // Menggunakan kelas .select2-edit (sesuai jawaban sebelumnya)
    $('[id^="modalEditPenjualan"]').each(function () {
        const modalElement = $(this);
        const id = modalElement.attr("id").split("modalEditPenjualan")[1];

        // Inisialisasi Select2 untuk Pelanggan di Modal Edit saat ditampilkan
        modalElement.on("shown.bs.modal", function () {
            modalElement.find(".select2-edit").select2({
                dropdownParent: modalElement,
                width: "100%",
                placeholder: "-- Pilih Pelanggan --",
            });

            // Panggil perhitungan Total dan Harga awal saat modal dibuka
            hitungTotalEdit(id);
        });

        // Hancurkan Select2 saat modal ditutup
        modalElement.on("hidden.bs.modal", function () {
            if (modalElement.find(".select2-edit").data("select2")) {
                modalElement.find(".select2-edit").select2("destroy");
            }
        });

        // Dengarkan perubahan pada Motor atau Jumlah (via select/change)
        modalElement.on(
            "change",
            '.motor-select-edit[data-id="' +
                id +
                '"], .jumlah-input-edit[data-id="' +
                id +
                '"]',
            function () {
                hitungTotalEdit(id);
            }
        );

        // Dengarkan perubahan pada Jumlah (via keyboard/input)
        modalElement.on(
            "input",
            '.jumlah-input-edit[data-id="' + id + '"]',
            function () {
                hitungTotalEdit(id);
            }
        );
    });
});
// Akhir dashboard.js

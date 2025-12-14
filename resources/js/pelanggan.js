$(document).ready(function () {
    $("#bookingTable").DataTable({
        pageLength: 5,
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
        },
    });

    $("#kreditTable").DataTable({
        pageLength: 5,
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
        },
    });

    $("#pembelianTable").DataTable({
        pageLength: 5,
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
        },
    });

    // Handle tab click untuk scroll ke tab
    $(".nav-tabs button").on("click", function () {
        const target = $(this).data("bs-target");
        $("html, body").animate(
            {
                scrollTop: $(target).offset().top - 100,
            },
            500
        );
    });

    // Handle navbar link click
    $(".navbar-nav a").on("click", function (e) {
        e.preventDefault();
        const target = $(this).attr("href");
        if (target.startsWith("#")) {
            // Aktifkan tab yang sesuai
            $(`button[data-bs-target="${target}"]`).tab("show");

            // Scroll ke tab
            $("html, body").animate(
                {
                    scrollTop: $(target).offset().top - 100,
                },
                500
            );
        }
    });
});
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".dp-input").forEach(function (input) {
        const modal = input.closest(".modal");

        // ambil input jumlah
        const jumlahInput = modal.querySelector(".jumlah-input");

        function hitungDP() {
            let harga = parseInt(input.getAttribute("data-harga"));
            let jumlah = parseInt(jumlahInput.value);

            if (!jumlah || jumlah < 1) jumlah = 1;

            let total = harga * jumlah;
            let dp = Math.floor(total * 0.2); // 20%

            input.value = dp;
        }

        // Ketika jumlah berubah → hitung ulang DP
        jumlahInput.addEventListener("input", hitungDP);

        // Hitung pertama kali saat modal dibuka
        hitungDP();
    });
});
document.addEventListener("DOMContentLoaded", function () {
    // Ambil semua form booking
    const bookingForms = document.querySelectorAll('form[id^="bookingForm"]');

    bookingForms.forEach((form) => {
        const jumlahInput = form.querySelector(".jumlah-input");
        const motorSelect = form.querySelector(".motor-select");
        const dpInput = form.querySelector(".dp-input");

        function updateDP() {
            const hargaMotor = parseFloat(
                motorSelect.selectedOptions[0].dataset.harga
            );
            const jumlah = parseInt(jumlahInput.value) || 1;
            dpInput.value = Math.round(hargaMotor * jumlah * 0.2);
        }

        // Hitung DP awal
        updateDP();

        // Update saat jumlah atau motor berubah
        jumlahInput.addEventListener("input", updateDP);
        motorSelect.addEventListener("change", updateDP);
    });
});
document.addEventListener("DOMContentLoaded", function () {
    // Ambil semua form booking
    const bookingForms = document.querySelectorAll('form[id^="bookingForm"]');

    bookingForms.forEach((form) => {
        const jumlahInput = form.querySelector(".jumlah-input");
        const motorSelect = form.querySelector(".motor-select");
        const dpInput = form.querySelector(".dp-input");

        function updateDP() {
            const hargaMotor =
                parseFloat(motorSelect.selectedOptions[0].dataset.harga) || 0;
            const jumlah = parseInt(jumlahInput.value) || 1;
            dpInput.value = Math.round(hargaMotor * jumlah * 0.2);
        }

        // Hitung DP awal saat modal dibuka
        updateDP();

        // Update saat jumlah atau motor berubah
        jumlahInput.addEventListener("input", updateDP);
        motorSelect.addEventListener("change", updateDP);

        // Optional: reset DP saat modal dibuka kembali
        form.closest(".modal").addEventListener("show.bs.modal", updateDP);
    });
});

document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
        e.preventDefault();

        const targetId = this.getAttribute("href");
        if (targetId === "#") return;

        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 70,
                behavior: "smooth",
            });
        }
    });
});

// Form submission simulation
document.querySelector("form").addEventListener("submit", function (e) {
    e.preventDefault();
    alert(
        "Terima kasih! Pesan Anda telah berhasil dikirim. Kami akan menghubungi Anda dalam waktu 1x24 jam."
    );
    this.reset();
});

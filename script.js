document.addEventListener("DOMContentLoaded", () => {
    const alertElements = document.querySelectorAll(".alert");
    alertElements.forEach(alert => {
        setTimeout(() => {
            alert.style.display = "none";
        }, 3000); // Sembunyikan alert setelah 3 detik
    });
});

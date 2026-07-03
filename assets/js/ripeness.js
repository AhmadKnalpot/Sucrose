// =========================
// Ambil elemen HTML
// =========================
const upload = document.getElementById("upload");
const camera = document.getElementById("camera");
const preview = document.getElementById("preview");
const predict = document.getElementById("predict");

// =========================
// Menampilkan gambar pada kotak preview
// =========================
function showPreview(file) {

    if (!file) return;

    const reader = new FileReader();

    reader.onload = function (e) {
        preview.src = e.target.result;
    };

    reader.readAsDataURL(file);
}

// Upload dari komputer
upload.addEventListener("change", function () {
    showPreview(this.files[0]);
});

// Kamera HP
camera.addEventListener("change", function () {
    showPreview(this.files[0]);
});

// Tombol Deteksi
predict.addEventListener("click", function () {

    const file = upload.files[0] || camera.files[0];

    if (!file) {
        alert("Pilih gambar terlebih dahulu.");
        return;
    }

    alert("Tahap berikutnya kita akan menghubungkan halaman ini dengan model Edge Impulse.");
});
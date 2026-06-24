// Fungsi Membuka & Menutup Sidebar Kiri (Drawer)
function toggleSidebar(open) {
    const sidebar = document.getElementById('sidebarMenu');
    const overlay = document.getElementById('sidebarOverlay');
    
    if (sidebar && overlay) {
        if (open) {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            setTimeout(() => overlay.classList.add('opacity-100'), 10);
        } else {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.remove('opacity-100');
            setTimeout(() => overlay.classList.add('hidden'), 30);
        }
    }
}

// Fungsi Menampilkan & Menyembunyikan Dropdown Profil Kanan
function toggleProfileDropdown() {
    const dropdown = document.getElementById('profileDropdown');
    if (dropdown) {
        dropdown.classList.toggle('hidden');
    }
}

// Menutup Dropdown Otomatis Jika Klik di Luar Menu
window.addEventListener('click', function(e) {
    const dropdown = document.getElementById('profileDropdown');
    if (dropdown && !dropdown.classList.contains('hidden')) {
        const profileBtn = dropdown.previousElementSibling;
        // Jika yang diklik bukan area dropdown dan bukan tombol profil, maka sembunyikan
        if (profileBtn && !dropdown.contains(e.target) && !profileBtn.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    }
});

// Fungsi pendeteksi file untuk mengubah teks kotak upload
function pasangPendeteksiFile(inputId, textId, teksAwal) {
    const fileInput = document.getElementById(inputId);
    const fileText = document.getElementById(textId);

    if (fileInput && fileText) {
        fileInput.addEventListener('change', function() {
            if (this.files && this.files.length > 0) {
                const namaFile = this.files[0].name;
                // Mengubah teks instruksi menjadi nama file dengan ikon centang hijau pekat
                fileText.innerHTML = `<span class="text-green-600 font-bold flex items-center justify-center truncate"><i class="fas fa-check-circle mr-1 text-xs shrink-0"></i> ${namaFile}</span>`;
            } else {
                fileText.innerHTML = teksAwal;
            }
        });
    }
}

// Menjalankan pemetaan ID setelah seluruh komponen halaman HTML selesai di-load sempurna
document.addEventListener('DOMContentLoaded', function() {
    pasangPendeteksiFile('input_ktp', 'text_ktp', 'Klik untuk upload');
    pasangPendeteksiFile('input_sertifikat', 'text_sertifikat', 'Klik untuk upload');
    pasangPendeteksiFile('input_spt_pbb', 'text_spt_pbb', 'Klik untuk upload');
    pasangPendeteksiFile('input_pernyataan', 'text_pernyataan', 'Klik untuk upload surat bertanda tangan');
    pasangPendeteksiFile('input_gambar', 'text_gambar', 'Klik untuk upload');
    pasangPendeteksiFile('input_opsional', 'text_opsional', 'Klik untuk upload (Jika ada)');
});
import './bootstrap';
document.addEventListener('DOMContentLoaded', function () {
    // Ambil elemen tombol logout, modal, dan backdrop
    const logoutButtons = document.querySelectorAll('[data-modal-toggle="add-data-modal"]');
    const modal = document.getElementById('add-data-modal');
    const backdrop = document.getElementById('backdrop');
    const closeButton = document.querySelector('[data-modal-hide="add-data-modal"]');

    // Fungsi untuk membuka modal
    function openModal() {
        modal.classList.remove('hidden');
        backdrop.classList.remove('hidden');
    }

    // Fungsi untuk menutup modal
    function closeModal() {
        modal.classList.add('hidden');
        backdrop.classList.add('hidden');
    }

    // Tambahkan event listener untuk tombol "Logout"
    logoutButtons.forEach(button => {
        button.addEventListener('click', openModal);
    });

    // Tambahkan event listener untuk tombol "Close"
    if (closeButton) {
        closeButton.addEventListener('click', closeModal);
    }

    // Tambahkan event listener untuk backdrop (klik di luar modal)
    backdrop.addEventListener('click', closeModal);
});

// modal delete
document.addEventListener("DOMContentLoaded", function () {
    // Tangkap semua tombol delete
    const deleteButtons = document.querySelectorAll('[data-modal-toggle="delete-modal"]');
    const modal = document.getElementById("delete-modal");
    const backdrop = document.getElementById("backdrop");
    const deleteForm = document.getElementById("delete-form");
    const deleteIdInput = document.getElementById("delete-id");
    const cancelDelete = document.getElementById("cancel-delete");

    deleteButtons.forEach(button => {
        button.addEventListener("click", function () {
            const itemId = this.getAttribute("data-id");
            const url = this.getAttribute("data-url");
            deleteIdInput.value = itemId;

            // Set action form ke endpoint yang sesuai
            deleteForm.action = url;

            // Tampilkan modal
            modal.classList.remove("hidden");
            backdrop.classList.remove("hidden");
        });
    });

    // Tombol batal (tidak jadi delete)
    cancelDelete.addEventListener("click", function () {
        modal.classList.add("hidden");
        backdrop.classList.add("hidden");
    });
});

// modal logout
document.addEventListener("DOMContentLoaded", function () {
    // Tangkap semua tombol logout
    const deleteButtons = document.querySelectorAll('[data-modal-toggle="logout-modal"]');
    const modal = document.getElementById("logout-modal");
    const backdrop = document.getElementById("backdrop");
    const cancelDelete = document.getElementById("cancel-logout");

    deleteButtons.forEach(button => {
        button.addEventListener("click", function () {
            modal.classList.remove("hidden");
            backdrop.classList.remove("hidden");
        });
    });

    // Tombol batal (tidak jadi logout)
    cancelDelete.addEventListener("click", function () {
        modal.classList.add("hidden");
        backdrop.classList.add("hidden");
    });
});

// drag and drop file
document.addEventListener("DOMContentLoaded", function () {
    const dropzone = document.getElementById("dropzone");
    const fileInput = document.getElementById("dropzone-file");
    const previewContainer = document.getElementById("dropzone-preview");
    const previewImage = document.getElementById("preview-image");
    const fileNameText = document.getElementById("file-name");
    const dropzoneText = document.getElementById("dropzone-text");

    // Prevent default behavior for drag events
    ["dragenter", "dragover", "dragleave", "drop"].forEach(eventName => {
        dropzone.addEventListener(eventName, function (e) {
            e.preventDefault();
            e.stopPropagation();
        });
    });

    // Highlight ketika drag over
    dropzone.addEventListener("dragover", function () {
        dropzone.classList.add("border-blue-500");
    });

    // Hapus highlight ketika drag leave
    dropzone.addEventListener("dragleave", function () {
        dropzone.classList.remove("border-blue-500");
    });

    // Handle file drop
    dropzone.addEventListener("drop", function (e) {
        dropzone.classList.remove("border-blue-500");
        let files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            previewFile(files[0]);
        }
    });

    // Handle file input change (jika user pilih manual)
    fileInput.addEventListener("change", function () {
        if (fileInput.files.length > 0) {
            previewFile(fileInput.files[0]);
        }
    });

    // Preview function
    function previewFile(file) {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onloadend = function () {
            previewImage.src = reader.result;
            fileNameText.textContent = file.name; // Tampilkan nama file

            // Ubah tampilan ke layout baru
            previewContainer.classList.remove("hidden"); // Munculin preview
            dropzoneText.classList.add("hidden"); // Sembunyikan teks awal
            dropzone.classList.add("flex-row", "justify-start"); // Atur flex ke row
        };
    }
});

// modal detail file
document.addEventListener("DOMContentLoaded", function () {
    // Ambil semua tombol "Lihat File"
    const lihatFileButtons = document.querySelectorAll("[data-modal-toggle='modal-detail']");

    // Loop setiap tombol dan tambahkan event listener
    lihatFileButtons.forEach(button => {
        button.addEventListener("click", function () {
            // Ambil data dari atribut tombol
            const pdfUrl = this.getAttribute("data-file-pdf");
            const gambarUrl = this.getAttribute("data-file-gambar");

            // Ambil elemen dalam modal
            const modal = document.getElementById("modal-detail");
            const pdfLink = modal.querySelector("#pdf-link");
            const gambarLink = modal.querySelector("#gambar-link");
            const gambarImg = modal.querySelector("#gambar-preview");

            // Cek apakah ada PDF
            if (pdfUrl && pdfUrl !== "null") {
                pdfLink.href = pdfUrl;
                pdfLink.parentElement.style.display = "none"; // Tampilkan
            } else {
                pdfLink.parentElement.style.display = "none"; // Sembunyikan jika tidak ada
            }

            // Cek apakah ada Gambar
            if (gambarUrl && gambarUrl !== "null") {
                gambarLink.href = gambarUrl;
                gambarImg.src = gambarUrl;
                gambarLink.parentElement.style.display = "none"; // Tampilkan
                gambarImg.style.display = "block"; // Tampilkan preview
            } else {
                gambarLink.parentElement.style.display = "none"; // Sembunyikan jika tidak ada
                gambarImg.style.display = "none"; // Sembunyikan preview
            }

            // Tampilkan modal
            modal.classList.remove("hidden");
        });
    });

    // Event listener untuk menutup modal
    document.getElementById("modal-close").addEventListener("click", function () {
        document.getElementById("modal-detail").classList.add("hidden");
    });
});

{/* <script> */}
document.addEventListener("DOMContentLoaded", function () {
    const toggleDisposisi = document.getElementById("toggleDisposisi");
    const disposisiForm = document.getElementById("disposisiForm");

    toggleDisposisi.addEventListener("change", function () {
        if (this.checked) {
            disposisiForm.classList.remove("hidden");
        } else {
            disposisiForm.classList.add("hidden");
        }
    });
});
// </script>

// Fungsi untuk toggle dropdown
// function toggleDropdownProfile() {
//     const dropdown = document.getElementById('dropdown-menu');
//     dropdown.classList.toggle('hidden');
// }

// // Menutup dropdown ketika user mengklik di luar dropdown
// window.addEventListener('click', function(event) {
//     const dropdown = document.getElementById('dropdown-menu');
//     const profileButton = document.getElementById('profile-button');

//     if (!profileButton.contains(event.target) && !dropdown.contains(event.target)) {
//         dropdown.classList.add('hidden');
//     }
// });

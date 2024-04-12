$(document).ready(function () {
    // Melakukan AJAX request ke server
    $.ajax({
        url: base_url + "ujian/logjawaban/",
        type: "POST", // Atau GET sesuai kebutuhan
        data: { action: "logujian" }, // Data yang ingin Anda kirim ke server
        success: function(response) {
            console.log("Berhasil memanggil fungsi logujian.");
            // Lakukan lebih banyak pekerjaan di sini sesuai kebutuhan
        },
        error: function(xhr, status, error) {
            console.error("Gagal memanggil fungsi logujian:", error);
        }
    });
  
});

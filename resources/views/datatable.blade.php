<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags untuk karakter set dan responsivitas -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Metadata dan favicon -->
    <meta name="description" content="">
    <meta name="author" content="Themepixels">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.png">

    <title>GeoNation - Datatable</title>

    <!-- CSS -->
    <link rel="stylesheet" href="/lib/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="/lib/datatable/css/datatables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/style.min.css">
</head>

<body>
    <main class="main-app">
        <div class="container">
            <div class="d-flex justify-content-between">
                <h3 class="title fw-bold">Selamat datang di Datatable</h3>
                <a href="{{ url('geomap') }}" class="btn btn-primary">Geomap</a>
            </div>

            <h5 class="title">List all Data Negara</h5>

            <div class="card card-example">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-responsive" id="mytable">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">No</th>
                                    <th scope="col" class="text-center">Nama Negara</th>
                                    <th scope="col" class="text-center">Kawasan</th>
                                    <th scope="col" class="text-center">Direktorat</th>
                                    <th scope="col" class="text-center">Created_At</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <!-- Data negara akan dimasukkan ke sini oleh JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div><!-- card-body -->
            </div><!-- card -->
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container main-footer">
            <span>&copy; 2024. GeoNation. All Rights Reserved.</span>
            <span>Created by: <a href="https://www.linkedin.com/in/muhammad-rizky-amalsyah17/" target="_blank">Muhammad
                    Rizky Amalsyah</a></span>
        </div><!-- main-footer -->
    </footer>

    <!-- Script -->
    <script src="/lib/jquery/jquery.min.js"></script>
    <script src="/lib/datatable/js/datatables.min.js"></script>
    <script>
        // Melakukan permintaan AJAX ke server untuk mendapatkan data negara dari endpoint API
        $.ajax({
            url: 'http://localhost:8000/api/negara',
            method: 'GET',
            success: function(response) {
                console.log("Data Negara yang dipanggil API:",response);

                let tableBody = $('#mytable tbody');

                // Iterasi setiap objek negara di dalam array response
                response.forEach(function(country, index) {
                    let row = `
                      <tr data-id="${country.id}">
                          <td>${index + 1}</td> <!-- Menampilkan nomor urut -->
                          <td>${country.country_name}</td> <!-- Menampilkan nama negara -->
                          <td>${country.region.nama_kawasan}</td> <!-- Menampilkan nama kawasan -->
                          <td>${country.direktorat.nama_direktorat}</td> <!-- Menampilkan nama direktorat -->
                          <td>${new Date(country.created_at).toLocaleDateString()}</td> <!-- Menampilkan tanggal pembuatan -->
                          <td class="text-center">
                              <div class="d-flex align-items-center justify-content-center">
                                  <!-- Tombol untuk menghapus negara -->
                                  <button class="btn btn-warning delete-btn" data-id="${country.id}">
                                      <i class="fa fa-trash-can text-white" alt="Delete"></i>
                                  </button>
                              </div>
                          </td>                      
                      </tr>
                    `;
                    tableBody.append(row); // Menambahkan baris baru ke dalam tabel
                });

                // Menginisialisasi DataTables setelah data dimasukkan ke dalam tabel
                $('#mytable').DataTable();

                // Event listener untuk tombol hapus
                $('.delete-btn').on('click', function() {
                    let countryId = $(this).data('id'); // Mendapatkan ID negara dari atribut data-id
                    deleteCountry(countryId); // Memanggil fungsi deleteCountry dengan ID negara
                });
            },
            error: function(error) {
                console.error("Gagal mengambil data dari API",
                    error); // Logging jika terjadi kesalahan saat mengambil data
            }
        });

        // Fungsi untuk menghapus negara berdasarkan ID
        function deleteCountry(id) {
            if (confirm('Apakah Anda yakin ingin menghapus negara ini?')) {
                $.ajax({
                    url: `http://localhost:8000/api/negara/${id}`,
                    method: 'DELETE', 
                    success: function() {
                        $(`tr[data-id="${id}"]`).remove(); // Menghapus baris tabel yang sesuai setelah berhasil dihapus
                        alert('Negara berhasil dihapus.');
                    },
                    error: function(error) {
                        console.error('Gagal menghapus negara:',error); // Logging jika terjadi kesalahan saat menghapus data
                        alert('Gagal menghapus negara.');
                    }
                });
            }
        }
    </script>
</body>

</html>

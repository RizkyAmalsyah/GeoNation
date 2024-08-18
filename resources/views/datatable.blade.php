<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Meta -->
    <meta name="description" content="">
    <meta name="author" content="Themepixels">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.png">
    <title>GeoNation - Datatable</title>
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="/lib/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="/lib/datatable/css/datatables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Template CSS -->
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
                    <!-- Tombol Hapus Banyak -->
                    <div class="d-flex justify-content-end">
                        <button id="deleteSelectedBtn" class="btn btn-danger mb-3">Hapus Data Terpilih</button>
                    </div>
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
                                <!-- Data akan diisi melalui JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div><!-- card-body -->
            </div><!-- card -->
        </div>
    </main>
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
            url: 'http://localhost:8000/api/negara', // URL endpoint API
            method: 'GET',
            success: function(response) {
                console.log("Data Negara yang dipanggil API:",
                    response); // Mencetak data negara yang diterima ke konsol
                let tableBody = $('#mytable tbody'); // Mendapatkan elemen <tbody> dari tabel

                // Melakukan iterasi terhadap setiap objek negara di dalam array response
                response.forEach(function(country, index) {
                    let row = `
                      <tr data-id="${country.id}">
                          <td>${index + 1}</td>
                          <td>${country.country_name}</td>
                          <td>${country.region.nama_kawasan}</td>
                          <td>${country.direktorat.nama_direktorat}</td>
                          <td>${new Date(country.created_at).toLocaleDateString()}</td>
                          <td class="text-center">
                              <div class="d-flex align-items-center justify-content-center">
                                  <input class="form-check-input me-2 delete-checkbox" type="checkbox" value="${country.id}">
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

                // Menambahkan event listener untuk tombol hapus
                $('.delete-btn').on('click', function() {
                    let countryId = $(this).data('id');
                    deleteCountry(countryId);
                });

                // Event listener untuk tombol hapus banyak
                $('#deleteSelectedBtn').on('click', function() {
                    let selectedIds = [];
                    $('.delete-checkbox:checked').each(function() {
                        selectedIds.push($(this).val());
                    });

                    if (selectedIds.length > 0) {
                        deleteMultipleCountries(selectedIds);
                    } else {
                        alert('Pilih data yang ingin dihapus!');
                    }
                });
            },
            error: function(error) {
                console.error("Gagal mengambil data dari API",
                    error); // Menampilkan pesan kesalahan jika gagal mengambil data dari API
            }
        });

        // Fungsi untuk menghapus negara
        function deleteCountry(id) {
            if (confirm('Apakah Anda yakin ingin menghapus negara ini?')) {
                $.ajax({
                    url: `http://localhost:8000/api/negara/${id}`,
                    method: 'DELETE',
                    success: function() {
                        $(`tr[data-id="${id}"]`).remove(); // Hapus baris tabel yang sesuai
                        alert('Negara berhasil dihapus.');
                    },
                    error: function(error) {
                        console.error('Gagal menghapus negara:', error);
                        alert('Gagal menghapus negara.');
                    }
                });
            }
        }

        // Fungsi untuk menghapus banyak negara
        function deleteMultipleCountries(ids) {
            if (confirm('Apakah Anda yakin ingin menghapus data yang dipilih?')) {
                $.ajax({
                    url: 'http://localhost:8000/api/negara/bulk-delete',
                    method: 'POST',
                    data: JSON.stringify({
                        ids: ids
                    }),
                    contentType: 'application/json',
                    success: function() {
                        ids.forEach(id => {
                            $(`tr[data-id="${id}"]`).remove(); // Hapus baris tabel yang sesuai
                        });
                        alert('Data berhasil dihapus.');
                    },
                    error: function(error) {
                        console.error('Gagal menghapus data:', error);
                        alert('Gagal menghapus data.');
                    }
                });
            }
        }
    </script>
</body>

</html>

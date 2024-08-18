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
    <title>GeoNation - GeoMap</title>
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="/lib/jqvmap/jqvmap.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="/assets/css/style.min.css">
</head>

<body>
  <main class="main-app">
    <div class="container">
      <div class="d-flex justify-content-between">
        <h3 class="title fw-bold">Selamat datang di Geomap</h3>
        <a href="{{ url('datatable') }}" class="btn btn-primary">
          Datatable
        </a>
      </div>
        <div class="card card-example">
            <div class="card-body">
                <div id="geomap" style="height:65vh;"></div>
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


    {{-- script --}}
    <script src="/lib/jquery/jquery.min.js"></script>
    <script src="/lib/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="/lib/jqvmap/jquery.vmap.min.js"></script>
    <script src="/lib/jqvmap/maps/jquery.vmap.world.js"></script>
    <script>
        // Melakukan permintaan AJAX ke server untuk mendapatkan data negara dari endpoint API
        $.ajax({
            url: 'http://localhost:8000/api/negara', // URL endpoint API
            method: 'GET',
            success: function(response) {
                console.log("Data Negara yang dipanggil API:", response); // Mencetak data negara yang diterima ke konsol

                let colors = {};
                let directorateColorMap = {};
                let colorPalette = ['#1a2369', '#4153d9', '#6984de', '#1c96e9', '#f8c471', '#a569bd', '#fd7e14',
                    '#28a745'
                ]; // Array warna yang bisa digunakan untuk mewarnai kawasan
                let colorIndex = 0;

                // Iterasi melalui setiap negara dalam response untuk membangun peta warna
                response.forEach(country => {
                    const directorateId = country.direktorat.id;

                    // Mengecek apakah direktorat sudah memiliki warna yang ditentukan
                    if (!directorateColorMap[directorateId]) {
                        directorateColorMap[directorateId] = colorPalette[colorIndex % colorPalette
                            .length];
                        colorIndex++;
                    }

                    // Tetapkan warna ke negara berdasarkan direktoratnya
                    colors[country.kode_negara.toLowerCase()] = directorateColorMap[directorateId];
                });

                // Menginisialisasi peta menggunakan plugin vectorMap
                $('#geomap').vectorMap({
                    map: 'world_en',
                    backgroundColor: '#fff',
                    borderColor: '#fff',
                    color: '#5f748a',
                    selectedColor: '#506fd9',
                    hoverColor: null,
                    hoverOpacity: 0.8,
                    enableZoom: true,
                    showTooltip: true,
                    colors: colors,
                    onLabelShow: function(event, label, code) {
                        // Menangani perubahan konten tooltip saat label ditampilkan
                        const countryData = response.find(country => country.kode_negara
                            .toLowerCase() === code);

                        // Jika data negara ditemukan, buat konten tooltip
                        if (countryData) {
                            let tooltipContent = `
                              <div class="d-flex gap-2 p-1">
                                <div>
                                  <img src="https://flagcdn.com/w320/${countryData.kode_negara.toLowerCase()}.png" alt="${countryData.country_name} Flag" style="width:100px;height:auto;">
                                </div>
                                <div>
                                  <h5 class="fw-bold">${countryData.country_name}</h5>
                                  <strong>Kawasan:</strong> ${countryData.region.nama_kawasan}<br>
                                  <strong>Direktorat:</strong> ${countryData.direktorat.nama_direktorat}
                                </div>
                              </div>
                            `;
                            // Mengganti konten tooltip dengan konten yang baru dibuat
                            label.html(tooltipContent);
                        }
                    }
                });
            },
            // Penanganan kesalahan jika permintaan ke server gagal
            error: function(error) {
                console.log("Error fetching data from API", error);
            }
        });
    </script>
</body>

</html>

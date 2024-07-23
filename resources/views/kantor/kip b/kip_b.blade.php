<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Dashboard - Kantor</title>
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

    <!-- Page CSS -->
    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!-- Config -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('partials.aside')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h3>Penyedia</h3>
                        <!-- Pencarian -->
                        <div class="row mb-3">
                            <div class="col text-end">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahBarang">Tambah Penyedia</button>
                            </div>
                        </div>

                        <!-- Modal Tambah Barang -->
                        <div class="modal fade" id="modalTambahBarang" tabindex="-1" aria-labelledby="modalTambahBarangLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTambahBarangLabel">Tambah Penyedia</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('penyedias.store') }}" method="POST">
                                            @csrf
                                            <!-- Input untuk nama barang -->
                                            <div class="mb-3">
                                                <label for="namaBarang" class="form-label">Nama Penyedia</label>
                                                <input type="text" class="form-control" id="namaBarang" name="nama" placeholder="Nama Penyedia" required>
                                            </div>
                                            <!-- Input untuk Lokasi -->
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">Alamat</label>
                                                <input type="text" class="form-control" id="lokasi" name="alamat" placeholder="Alamat" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">NPWP</label>
                                                <input type="text" class="form-control" id="lokasi" name="npwp" placeholder="NPWP" required>
                                            </div>
                                            <!-- Tombol untuk menyimpan data -->
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Filter Section -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="jenis_barang" id="filter-jenis-barang" placeholder=" Filter Nama Jenis Barang">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="tahun_beli" id="filter-tahun-beli" placeholder="Filter Tahun Beli">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="kondisi" id="filter-kondisi" placeholder="Filter Kondisi">
                            </div>
                        </div>

                        <!-- Tabel Barang -->
                        <div class="card">
                            <div class="table-responsive text-nowrap">
                                <table id="kipb_table" class="table table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Kode Barang</th>
                                            <th>Jenis Barang</th>
                                            <th>No Register</th>
                                            <th>Merk</th>
                                            <th>Type</th>
                                            <th>Ukuran</th>
                                            <th>Bahan</th>
                                            <th>Tahun Beli</th>
                                            <th>No Pabrik</th>
                                            <th>No Rangka</th>
                                            <th>No Mesin</th>
                                            <th>No Polisi</th>
                                            <th>No BPKB</th>
                                            <th>Asal Usul</th>
                                            <th>Harga</th>
                                            <th>Beban Susut</th>
                                            <th>Nilai Buku</th>
                                            <th>Kondisi</th>
                                            <th>Lokasi</th>
                                            <th>Actions</th>                                        
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0" id="table-body">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- / Content -->
                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#kipb_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: { 
                    url: '{{ route('kipbs.data') }}',
                    type: 'GET',
                    data: function(d) {
                        d.jenis_barang = $('#filter-jenis-barang').val();
                        d.tahun_beli = $('#filter-tahun-beli').val();
                        d.kondisi = $('#filter-kondisi').val();
                    }
                },
                columns: [
                    { data: 'kode_barang', name: 'kode_barang' },
                    { data: 'jenis_barang', name: 'jenis_barang' },
                    { data: 'no_register', name: 'no_register' },
                    { data: 'merk', name: 'merk' },
                    { data: 'type', name: 'type' },
                    { data: 'ukuran', name: 'ukuran' },
                    { data: 'bahan', name: 'bahan' },
                    { data: 'tahun_beli', name: 'tahun_beli' },
                    { data: 'no_pabrik', name: 'no_pabrik' },
                    { data: 'no_rangka', name: 'no_rangka' },
                    { data: 'no_mesin', name: 'no_mesin' },
                    { data: 'no_polisi', name: 'no_polisi' },
                    { data: 'no_bpkb', name: 'no_bpkb' },
                    { data: 'asal_usul', name: 'asal_usul' },
                    { data: 'harga', name: 'harga' },
                    { data: 'beban_susut', name: 'beban_susut' },
                    { data: 'nilai_buku', name: 'nilai_buku' },
                    { data: 'kondisi', name: 'kondisi' },
                    { data: 'lokasi', name: 'lokasi' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $('#filter-jenis-barang, #filter-tahun-beli, #filter-kondisi').on('keyup change', function() {
                table.draw();
            });
        });
    </script>
</body>
</html>

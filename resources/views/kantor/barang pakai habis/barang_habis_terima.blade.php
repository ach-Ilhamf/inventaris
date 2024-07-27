<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum=1.0" />
    <title>Dashboard - Kantor</title>
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

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
                        <h3>Penerimaan Barang Pakai Habis</h3>
                        <!-- Pencarian -->
                        <div class="row mb-3">
                            <div class="col text-end">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalTambahBarang">Tambah Penerimaan Barang Pakai Habis</button>
                            </div>
                        </div>

                        <!-- Modal Tambah Barang -->
                        <div class="modal fade" id="modalTambahBarang" tabindex="-1"
                            aria-labelledby="modalTambahBarangLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTambahBarangLabel">Tambah Penerimaan Barang Pakai Habis</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('baranghabisterimas.store') }}" method="POST">
                                            @csrf
                                            <!-- Input untuk nama barang -->
                                            <div class="mb-3">
                                                <label for="namaBarang" class="form-label">Kode Barang</label>
                                                <input type="text" class="form-control" id="namaBarang" name="kode_barang"
                                                    placeholder="Kode Barang" required>
                                            </div>
                                            <!-- Input untuk Lokasi -->
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">Jenis Barang Yang Dibeli</label>
                                                <input type="text" class="form-control" id="lokasi" name="jenis_barang"
                                                    placeholder="Jenis Barang Yang Dibeli" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">Tanggal SPK/perjanjian/Kontrak</label>
                                                <input type="date" class="form-control" id="lokasi" name="tgl_spk"
                                                    placeholder="Tanggal SPK/Perjanjian/Kontrak" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">No SPK/perjanjian/Kontrak</label>
                                                <input type="text" class="form-control" id="lokasi" name="no_spk"
                                                    placeholder="No SPK/Perjanjian/Kontrak" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">Tanggal DPA/SPM/Kwitansi</label>
                                                <input type="date" class="form-control" id="lokasi" name="tgl_dpa"
                                                    placeholder="Tanggal DPA/SPM/Kwitansi" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">No DPA/SPM/Kwitansi</label>
                                                <input type="text" class="form-control" id="lokasi" name="no_dpa"
                                                    placeholder="No DPA/SPM/Kwitansi" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">Banyak Barang</label>
                                                <input type="number" class="form-control" id="lokasi" name="banyak_barang"
                                                    placeholder="Banyak Barang" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">Harga Satuan</label>
                                                <input type="number" class="form-control" id="lokasi" name="harga_satuan"
                                                    placeholder="Harga Satuan" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">Dipergunakan Pada Unit</label>
                                                <input type="text" class="form-control" id="lokasi" name="unit"
                                                    placeholder="Dipergunakan Pada Unit" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">Keterangan</label>
                                                <input type="text" class="form-control" id="lokasi" name="keterangan"
                                                    placeholder="Keterangan" required>
                                            </div>
                                            <!-- Tombol untuk menyimpan data -->
                                            <button onclick="return confirm('Apakah Anda Yakin Untuk Menambah Penerimaan Barang ?');" type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabel Penyedia -->
                        <div class="card">
                            <div class="table-responsive text-nowrap">
                                <table id="penyedia_table" class="table table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Kode Barang</th>
                                            <th>Jenis Barang Yang Dibeli</th>
                                            <th>Tanggal SPK/Perjanjian/kontrak</th>
                                            <th>No SPK/Perjanjian/kontrak</th>
                                            <th>Tanggal DPA/SPM/Kwitansi</th>
                                            <th>No DPA/SPM/Kwitansi</th>
                                            <th>Banyaknya Barang</th>
                                            <th>Harga Satuan</th>
                                            <th>Dipergunakan Pada Unit</th>
                                            <th>Keterangan</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    
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

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#penyedia_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('penyedias.data') }}',
                columns: [
                    { data: 'nama', name: 'nama' },
                    { data: 'alamat', name: 'alamat' },
                    { data: 'npwp', name: 'npwp' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });
    </script>
</body>
</html>

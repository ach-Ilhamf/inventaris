<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum=1.0" />
    <title>Penerimaan Barang Pakai Habis</title>
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
                            <div class="col d-flex justify-content-between">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#modalCetak">Cetak Penerimaan Barang Pakai Habis</button>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalTambahBarang">Tambah Penerimaan</button>
                            </div>
                        </div>
                        <!-- Filter Section -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="jenis_barang" id="filter-jenis-barang" placeholder=" Filter Jenis Barang">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="tgl_terima" id="filter-tgl-terima" placeholder="Filter Tanggal Terima">
                            </div>
                        </div>
                        <div class="modal fade" id="modalCetak" tabindex="-1"
                        aria-labelledby="modalTambahBarangLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTambahBarangLabel">Cetak Penerimaan Barang Pakai Habis</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('export.barangterima') }}" method="GET">
                                        @csrf
                                        <input type="hidden" name="jenis_barang" id="export-jenis-barang">
                                        <input type="hidden" name="tgl_terima" id="export-tgl-terima">
                                        <input type="hidden" class="form-control" name="left_position" id="right_position" 
                                                value="Kepala Bidang">
                                        <input type="hidden" class="form-control" name="right_position" id="left_position" 
                                                value="Pengurus Barang">

                                        <div class="mb-3">    
                                            <label for="approval_date" class="form-label">Tanggal Persetujuan </label>
                                            <input type="date" class="form-control" name="approval_date" id="approval_date" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="left_name" class="form-label">Nama Kepala Bidang</label>
                                            <input type="text" class="form-control" name="left_name" id="left_name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="left_nip" class="form-label">NIP Kepala Bidang</label>
                                            <input type="text" class="form-control" name="left_nip" id="left_nip" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="right_name" class="form-label">Nama Pengurus Barang</label>
                                            <input type="text" class="form-control" name="right_name" id="right_name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="right_nip" class="form-label">NIP Pegurus Barang</label>
                                            <input type="text" class="form-control" name="right_nip" id="right_nip" required> 
                                        </div>
                                        <button onclick="return confirm('Apakah Anda Yakin Untuk Mencetak ?');" class="btn btn-success">Cetak</button>
                                    </form>
                                </div>
                            </div>
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
                                        <form action="{{ route('barangterimas.store') }}" method="POST">
                                            @csrf
                                            <!-- Input untuk nama barang -->
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="namaBarang" class="form-label">Kode Barang</label>
                                                        <input type="text" class="form-control" id="namaBarang" name="kode_barang"
                                                            placeholder="Kode Barang">
                                                    </div>
                                                    <div class="col">
                                                        <label for="penyedia" class="form-label">Jenis Barang</label>
                                                        <select class="form-control" id="penyedia" name="id_barang"
                                                            required>
                                                            @foreach($barangList as $barang)
                                                            <option value="{{ $barang->id }}">
                                                                {{ $barang->jenis_barang }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">Tanggal Terima Barang</label>
                                                <input type="date" class="form-control" id="lokasi" name="tgl_terima"
                                                    placeholder="Tanggal Terima Barang" required>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Tanggal SPK/perjanjian/Kontrak</label>
                                                        <input type="date" class="form-control" id="lokasi" name="tgl_spk"
                                                            placeholder="Tanggal SPK/Perjanjian/Kontrak">
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">No SPK/perjanjian/Kontrak</label>
                                                        <input type="text" class="form-control" id="lokasi" name="no_spk"
                                                            placeholder="No SPK/Perjanjian/Kontrak">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Tanggal DPA/SPM/Kwitansi</label>
                                                        <input type="date" class="form-control" id="lokasi" name="tgl_dpa"
                                                            placeholder="Tanggal DPA/SPM/Kwitansi">
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">No DPA/SPM/Kwitansi</label>
                                                        <input type="text" class="form-control" id="lokasi" name="no_dpa"
                                                            placeholder="No DPA/SPM/Kwitansi">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Banyak Barang</label>
                                                        <input type="number" class="form-control" id="lokasi" name="banyak_barang"
                                                            placeholder="Banyak Barang" required>
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Harga Satuan</label>
                                                        <input type="number" class="form-control" id="lokasi" name="harga_satuan"
                                                            placeholder="Harga Satuan" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Dipergunakan Pada Unit</label>
                                                        <select class="form-control" id="lokasi" name="unit" required>
                                                            <option value="">Pilih Lokasi</option>
                                                            <option value="Kepala Dinas">Kepala Dinas</option>
                                                            <option value="Sekretariat">Sekretariat</option>
                                                            <option value="Sekretaris">Sekretaris</option>
                                                            <option value="Bidang TI">Bidang TI</option>
                                                            <option value="Bidang SIB">Bidang SIB</option>
                                                            <option value="Bidang SPBE">Bidang SPBE</option>
                                                            <option value="Ruang Rapat">Ruang Rapat</option>
                                                            <option value="Radio">Radio</option>
                                                            <option value="Call Center">Call Center</option>
                                                            <option value="Server Kominfo">Server Kominfo</option>
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Keterangan</label>
                                                        <input type="text" class="form-control" id="lokasi" name="keterangan"
                                                            placeholder="Keterangan">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Tombol untuk menyimpan data -->
                                            <button onclick="return confirm('Apakah Anda Yakin Untuk Menambah Penerimaan Barang ?');" type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($errors->any())
                        <div class="alert alert-danger" id="error-alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if(session('success'))
                        <div class="alert alert-success" id="success-alert">
                            {{ session('success') }}
                        </div>
                        @endif

                        <!-- Tabel Penyedia -->
                        <div class="card">
                            <div class="table-responsive text-nowrap">
                                <table id="barang_table" class="table table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Kode Barang</th>
                                            <th>Jenis Barang</th>
                                            <th>Tanggal Terima</th>
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
            var table = $('#barang_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('barangterimas.data') }}',
                    type: 'GET',
                    data: function(d) {
                        d.jenis_barang = $('#filter-jenis-barang').val();
                        d.tgl_terima = $('#filter-tgl-terima').val();
                        d.harga_satuan = $('#filter-harga-satuan').val();
                    }
                },
                columns: [
                    { data: 'kode_barang', name: 'kode_barang' },
                    { data: 'barangpakaihabis.jenis_barang', name: 'barangpakaihabis.jenis_barang' },
                    { data: 'tgl_terima', name: 'tgl_terima' },
                    { data: 'tgl_spk', name: 'tgl_spk' },
                    { data: 'no_spk', name: 'no_spk' },
                    { data: 'tgl_dpa', name: 'tgl_dpa' },
                    { data: 'no_dpa', name: 'no_dpa' },
                    { data: 'banyak_barang', name: 'banyak_barang' },
                    { data: 'harga_satuan', name: 'harga_satuan', render: function(data, type, row) {
                        return 'Rp ' + parseInt(data).toLocaleString('id-ID');}  },
                    { data: 'unit', name: 'unit' },
                    { data: 'keterangan', name: 'keterangan' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $('#filter-jenis-barang, #filter-tgl-terima').on('keyup change', function() {
                table.draw();
            });

             // Sinkronisasi filter dengan form ekspor
             $('#filter-jenis-barang').on('change keyup', function() {
                $('#export-jenis-barang').val($(this).val());
            });
            $('#filter-tgl-terima').on('change keyup', function() {
                $('#export-tgl-terima').val($(this).val());
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $("#success-alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
    
                $("#error-alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 3000); 
        });
    </script>
    <script>
            // test untuk button
            document.getElementById('export-btn').addEventListener('click', function() {
                let jenisBarang= document.getElementById('filter-jenis-barang').value;
                let tanggalTerima = document.getElementById('filter-tanggal-terima').value;
        
                let url = new URL('{{ route('export.barangterima') }}');
                url.searchParams.append('jenis_barang', jenisBarang);
                url.searchParams.append('tanggal_terima', tanggalTerima);
        
                window.location.href = url;
            });
    </script>        

</body>
</html>

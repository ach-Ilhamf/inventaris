<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Barang KIP-B</title>
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
                        <h3>Barang KIP-B</h3>
                        <div class="row mb-3">
                            <div class="col d-flex justify-content-between">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#modalCetak">Cetak Barang KIP-B</button>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" 
                                    data-bs-target="#modalTambahBarang">Tambah Barang</button>
                            </div>
                        </div>
                        <!-- Filter Section -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="nama_barang" id="filter-nama-barang" placeholder=" Filter Jenis Barang">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="tahun_beli" id="filter-tahun-beli" placeholder="Filter Tahun Beli">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="kondisi" id="filter-kondisi" placeholder="Filter Kondisi">
                            </div>
                        </div>
                        <div class="modal fade" id="modalCetak" tabindex="-1"
                        aria-labelledby="modalTambahBarangLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTambahBarangLabel">Cetak Barang KIP-B</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('export.kipb') }}" method="GET">
                                        @csrf
                                        <input type="hidden" name="nama_barang" id="export-nama-barang">
                                        <input type="hidden" name="tahun_beli" id="export-tahun-beli">
                                        <input type="hidden" name="kondisi" id="export-kondisi">
                                        <input type="hidden" class="form-control" name="left_position" id="right_position" 
                                                value="Kepala Dinas Komunikasi Dan Informatika">
                                        <input type="hidden" class="form-control" name="right_position" id="left_position" 
                                                value="Pengelola Pemanfaatan Barang">

                                        <div class="mb-3">    
                                            <label for="approval_date" class="form-label">Tanggal Persetujuan </label>
                                            <input type="date" class="form-control" name="approval_date" id="approval_date" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="left_name" class="form-label">Nama Kepala Dinas</label>
                                            <input type="text" class="form-control" name="left_name" id="left_name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="left_nip" class="form-label">NIP Kepala Dinas</label>
                                            <input type="text" class="form-control" name="left_nip" id="left_nip" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="right_name" class="form-label">Nama Pengelola Pemanfaatan Barang</label>
                                            <input type="text" class="form-control" name="right_name" id="right_name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="right_nip" class="form-label">NIP Pengelola Pemanfaatan Barang</label>
                                            <input type="text" class="form-control" name="right_nip" id="right_nip" required> 
                                        </div>
                                        <button onclick="return confirm('Apakah Anda Yakin Untuk Mencetak ?');" class="btn btn-success">Cetak</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                        <!-- Modal Tambah Barang -->
                        <div class="modal fade" id="modalTambahBarang" tabindex="-1" aria-labelledby="modalTambahBarangLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTambahBarangLabel">Tambah Barang</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('kipbs.store') }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="penyedia" class="form-label">Kode Barang</label>
                                                        <select class="form-control" id="penyedia" name="kode_barang"
                                                            required>
                                                            @foreach($kodes as $kode)
                                                            <option value="{{ $kode->kode_barang }}">
                                                                {{ $kode->kode_barang }} - {{ $kode->jenis_barang }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Jenis Barang</label>
                                                        <input type="text" class="form-control" id="lokasi"
                                                            name="nama_barang" placeholder="Jenis Barang" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">No Register</label>
                                                        <input type="text" class="form-control" id="lokasi" name="no_register"
                                                            placeholder="No Register" required>
                                                    </div>
                                                    <div class="col">
                                                        <label for="penyedia" class="form-label">Nama Pegawai</label>
                                                        <select class="form-control" id="penyedia" name="id_pegawai"
                                                            required>
                                                            @foreach($pegawaiList as $pegawai)
                                                            <option value="{{ $pegawai->id }}">
                                                                {{ $pegawai->nama_pegawai }} - {{ $pegawai->unit }} 
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Merk</label>
                                                        <input type="text" class="form-control" id="lokasi" name="merk"
                                                            placeholder="Merk">
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Type</label>
                                                        <input type="text" class="form-control" id="lokasi" name="tipe"
                                                            placeholder="Type">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Ukuran</label>
                                                        <input type="text" class="form-control" id="lokasi"
                                                            name="ukuran" placeholder="Ukuran">
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Bahan</label>
                                                        <input type="text" class="form-control" id="lokasi" name="merk"
                                                            placeholder="Bahan">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">Tahun Beli</label>
                                                <input type="text" class="form-control" id="lokasi" name="tahun_beli"
                                                    placeholder="Tahun Beli" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">No Pabrik</label>
                                                <input type="text" class="form-control" id="lokasi" name="no_pabrik"
                                                    placeholder="No Pabrik">
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">No Rangka</label>
                                                        <input type="text" class="form-control" id="lokasi"
                                                            name="no_rangka" placeholder="No Rangka">
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">No Mesin</label>
                                                        <input type="text" class="form-control" id="lokasi"
                                                            name="no_mesin" placeholder="No Mesin">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">No Polisi</label>
                                                        <input type="text" class="form-control" id="lokasi"
                                                            name="no_polisi" placeholder="No Polisi">
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">No BPKB</label>
                                                        <input type="text" class="form-control" id="lokasi"
                                                            name="no_bpkb" placeholder="No BPKB">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">Asal Usul</label>
                                                <input type="text" class="form-control" id="lokasi" name="asal_usul"
                                                    placeholder="Asal Usul">
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Harga</label>
                                                        <input type="number" class="form-control" id="lokasi"
                                                            name="harga_satuan" placeholder="Harga" required>
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Beban Susut</label>
                                                        <input type="number" class="form-control" id="lokasi"
                                                            name="beban_susut" placeholder="Beban Susut">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">Nilai Buku</label>
                                                <input type="number" class="form-control" id="lokasi" name="nilai_buku"
                                                    placeholder="Nilai Buku">
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Kondisi</label>
                                                        <select class="form-control" id="lokasi" name="kondisi"
                                                            required>
                                                            <option value="">Pilih Kondisi</option>
                                                            <option value="BAIK">BAIK</option>
                                                            <option value="KURANG BAIK">KURANG BAIK</option>
                                                            <option value="RUSAK BERAT">RUSAK BERAT</option>
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Lokasi</label>
                                                        <select class="form-control" id="lokasi" name="lokasi" required>
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
                                                </div>
                                            </div>
                                            <button onclick="return confirm('Apakah Anda Yakin Untuk Menambah Barang ?');" type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
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

                        <!-- Tabel Barang -->
                        <div class="card">
                            <div class="table-responsive text-nowrap">
                                <table id="kipb_table" class="table table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Kode Barang</th>
                                            <th>Jenis Barang</th>
                                            <th>No Register</th>
                                            <th>Nama Pegawai</th>
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
                        d.nama_barang = $('#filter-nama-barang').val();
                        d.tahun_beli = $('#filter-tahun-beli').val();
                        d.kondisi = $('#filter-kondisi').val();
                    }
                },
                columns: [
                    { data: 'kode_barang', name: 'kode_barang'},
                    { data: 'nama_barang', name: 'nama_barang' },
                    { data: 'no_register', name: 'no_register' },
                    { data: 'pegawai.nama_pegawai', name: 'pegawai.nama_pegawai'},
                    { data: 'merk', name: 'merk' },
                    { data: 'tipe', name: 'tipe' },
                    { data: 'ukuran', name: 'ukuran' },
                    { data: 'bahan', name: 'bahan' },
                    { data: 'tahun_beli', name: 'tahun_beli' },
                    { data: 'no_pabrik', name: 'no_pabrik' },
                    { data: 'no_rangka', name: 'no_rangka' },
                    { data: 'no_mesin', name: 'no_mesin' },
                    { data: 'no_polisi', name: 'no_polisi' },
                    { data: 'no_bpkb', name: 'no_bpkb' },
                    { data: 'asal_usul', name: 'asal_usul' },
                    { data: 'harga_satuan', name: 'harga_satuan', render: function(data, type, row) {
                        return 'Rp ' + parseInt(data).toLocaleString('id-ID'); } },
                    { data: 'beban_susut', name: 'beban_susut' },
                    { data: 'nilai_buku', name: 'nilai_buku' },
                    { data: 'kondisi', name: 'kondisi' },
                    { data: 'lokasi', name: 'lokasi' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $('#filter-nama-barang, #filter-tahun-beli, #filter-kondisi').on('keyup change', function() {
                table.draw();
            });
             // Sinkronisasi filter dengan form ekspor
             $('#filter-nama-barang').on('change keyup', function() {
                $('#export-nama-barang').val($(this).val());
            });
            $('#filter-tahun-beli').on('change keyup', function() {
                $('#export-tahun-beli').val($(this).val());
            });
            $('#filter-kondisi').on('change keyup', function() {
                $('#export-kondisi').val($(this).val());
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
                let namaBarang = document.getElementById('filter-nama-barang').value;
                let tahunBeli = document.getElementById('filter-tahun-beli').value;
                let kondisi = document.getElementById('filter-kondisi').value;
        
                let url = new URL('{{ route('export.kipb') }}');
                url.searchParams.append('nama_barang', namaBarang);
                url.searchParams.append('tahun_beli', tahunBeli);
                url.searchParams.append('kondisi', kondisi);
        
                window.location.href = url;
            });
    </script>        
</body>
</html>

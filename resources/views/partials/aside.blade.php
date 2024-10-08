<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="" class="app-brand-link">
        <img src="{{ asset('img/logo/logo.png') }}" height="30">
        <span class="app-brand-text menu-text fw-bolder ms-2" style="margin-left: 20px ">
        <b>ASET DINAS KOMINFO</b></span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
      <!-- Dashboard -->
      <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-home-circle"></i>
              <div data-i18n="Analytics">Data Barang</div>
          </a>
          <ul class="menu-sub">
              <li class="menu-item">
                  <a href="{{ route('kodes.index') }}" class="menu-link">
                      <div data-i18n="Account">Kode Barang KIP B</div>
                  </a>
              </li>
              <li class="menu-item">
                <a href="{{ route('kipbs.index') }}" class="menu-link">
                    <div data-i18n="Account">Barang KIP B</div>
                </a>
            </li>
              <li class="menu-item">
                  <a href="{{ route('barangs.index') }}" class="menu-link">
                      <div data-i18n="Notifications">Barang Pakai Habis</div>
                  </a>
              </li>
          </ul>
      </li>

      <!-- Components -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Fitur</span></li>      
      <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Analytics">Kegiatan Masuk</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('penyedias.index') }}" class="menu-link">
                        <div data-i18n="Account">Daftar Penyedia</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('pegawais.index') }}" class="menu-link">
                        <div data-i18n="Account">Daftar Pegawai</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('agendas.index') }}" class="menu-link">
                        <div data-i18n="Notifications">Daftar Kegiatan Masuk</div>
                    </a>
                </li>
            </ul>
        </li>
  
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Analytics">Barang Pakai Habis</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('barangterimas.index') }}" class="menu-link">
                        <div data-i18n="Account">Daftar Penerimaan Barang Pakai Habis</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('barangkeluars.index') }}" class="menu-link">
                        <div data-i18n="Notifications">Daftar Pengeluaran Barang Pakai Habis</div>
                    </a>
                </li>
            </ul>
        </li>
      
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Settings</span></li>      
        <li class="menu-item">
            <a href="{{route('edit-user')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Basic">Akun</div>
            </a>
        </li>
        <li class="menu-item">
          <a href="/logout" class="menu-link">
            <i class="menu-icon tf-icons bx bx-log-out"></i>
              <div data-i18n="Basic">Log Out</div>
          </a>
        </li>
  </ul>
</aside>

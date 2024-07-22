<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="" class="app-brand-link">
      <img src="../../img/logo/logo.png" height="24">
      <span class="app-brand-text demo menu-text fw-bolder ms-2">Minvento</span>
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
              <div data-i18n="Analytics">Dashboard</div>
          </a>
          <ul class="menu-sub">
              <li class="menu-item">
                  <a href="{{ route('agendas.index') }}" class="menu-link">
                      <div data-i18n="Account">Agenda Masuk</div>
                  </a>
              </li>
              <li class="menu-item">
                  <a href="" class="menu-link">
                      <div data-i18n="Notifications">Data Memorial</div>
                  </a>
              </li>
              <li class="menu-item">
                  <a href="{{ route('penyedias.index') }}" class="menu-link">
                      <div data-i18n="Notifications">Penyedia</div>
                  </a>
              </li>
          </ul>
      </li>

      <!-- Components -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Fitur</span></li>      
      <li class="menu-item">
          <a href="{{ route('kipbs.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-collection"></i>
              <div data-i18n="Basic">Barang KIP-B</div>
          </a>
      </li>

      <li class="menu-item">
          <a href="" class="menu-link">
              <i class="menu-icon tf-icons bx bx-collection"></i>
              <div data-i18n="Basic">Barang Pakai Habis</div>
          </a>
      </li>
      
      <li class="menu-item">
          <a href="" class="menu-link">
              <i class="menu-icon tf-icons bx bx-collection"></i>
              <div data-i18n="Basic">Log Activity</div>
          </a>
      </li>
  </ul>
</aside>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url('home') }}" class="brand-link">
      <img src="{{ asset('logo.png') }}"  class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('logo.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ url('admin/profile') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
                <a href="{{ url('home') }}" class="nav-link {{ (request()->is('home')) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-home"></i>
                  <p>
                    HOME
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/email') }}" class="nav-link {{ (request()->is('admin/email')) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-envelope"></i>
                  <p>
                    EMAIL
                  </p>
                </a>
              </li>
              @php
              $array_master = ['admin/pengguna','admin/pengguna/*','admin/gelombang','admin/gelombang/*','admin/alur','admin/alur/*','admin/info','admin/info/*','admin/imageslider','admin/imageslider/*','admin/prodi','admin/prodi/*'];
              @endphp
          <li class="nav-item has-treeview {{ (request()->is($array_master)) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->is($array_master)) ? 'active' : '' }}">
              <i class="nav-icon fas fa-list-alt "></i>
              <p>
                MASTER
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item">
                  <a href="{{ url('admin/pengguna') }}" class="nav-link {{ (request()->is(['admin/pengguna','admin/pengguna/*'])) ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>PENGGUNA</p>
                  </a>
              </li>
              
                <li class="nav-item">
                    <a href="{{ url('admin/imageslider') }}" class="nav-link {{ (request()->is(['admin/imageslider','admin/imageslider/*'])) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>IMAGE SLIDER</p>
                    </a>
                </li>

                <li class="nav-item">
                  <a href="{{ url('admin/prodi') }}" class="nav-link {{ (request()->is(['admin/prodi','admin/prodi/*'])) ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>PROGRAM STUDI</p>
                  </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('admin/gelombang') }}" class="nav-link {{ (request()->is(['admin/gelombang','admin/gelombang/*'])) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>GELOMBANG</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/alur') }}" class="nav-link {{ (request()->is(['admin/alur','admin/alur/*'])) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ALUR</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/info') }}" class="nav-link {{ (request()->is(['admin/info','admin/info/*'])) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>INFO</p>
                </a>
              </li>
            </ul>
          </li>
          @php
          $array_transaksi = ['admin/daftar','admin/daftar/*','admin/formulir','admin/formulir/*','admin/lulus','admin/lulus/*','admin/validasi','admin/validasi/*'];
          @endphp
          <li class="nav-item has-treeview {{ (request()->is($array_transaksi)) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->is($array_transaksi)) ? 'active' : '' }}">
              <i class="nav-icon fas fa-keyboard "></i>
              <p>
                TRANSAKSI
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ url('admin/daftar') }}" class="nav-link {{ (request()->is(['admin/daftar','admin/daftar/*'])) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DAFTAR</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('admin/validasi') }}" class="nav-link {{ (request()->is(['admin/validasi','admin/validasi/*'])) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>VALIDASI</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('admin/formulir') }}" class="nav-link {{ (request()->is(['admin/formulir','admin/formulir/*'])) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>FORMULIR</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('admin/lulus') }}" class="nav-link {{ (request()->is(['admin/lulus','admin/lulus/*'])) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>LULUS</p>
                </a>
              </li>
            </ul>
          </li>
          @php
          $array_laporan = ['admin/lapdaftar','admin/lapformulir','admin/laplulus'];
          @endphp
          <li class="nav-item has-treeview {{ (request()->is($array_laporan)) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->is($array_laporan)) ? 'active' : '' }}">
              <i class="nav-icon fas fa-print "></i>
              <p>
                LAPORAN
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/lapdaftar') }}" class="nav-link {{ (request()->is('admin/lapdaftar')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DAFTAR</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/lapformulir') }}" class="nav-link {{ (request()->is('admin/lapformulir')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>FORMULIR</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('admin/laplulus') }}" class="nav-link {{ (request()->is('admin/laplulus')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>LULUS</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                LOGOUT
              </p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

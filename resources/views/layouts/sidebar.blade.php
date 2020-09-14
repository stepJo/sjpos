<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-indigo text-sm elevation-4">
  
  <!-- Brand Logo -->
  <a href="{{ url('dashboard') }}">

    <div class="mt-3">

      <span class="font-weight-bold text-lg text-white mx-3">{{ $profile->app_name }}</span>

      {!! Utilities::renderImage('profiles', $profile->app_logo) !!}

    </div>
  
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 mb-3 d-flex">

      <div class="info">

        <span class="text-warning">User : &nbsp;</span>

        <p class="text-white font-weight-bold">{{ Auth::user()->u_name }}</p>

        <span class="text-warning">Email : &nbsp;</span>

        <p class="text-white font-weight-bold">{{ Auth::user()->u_email }}</p>

        <span class="text-warning">Role : &nbsp;</span>

        <p class="text-white font-weight-bold">{{ Session::get('role_name') }}</p>
      
      </div>

    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">

      <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">

          <a href="{{ url('dashboard') }}" class="nav-link">

            <i class="nav-icon fas fa-tachometer-alt"></i>

            <p>

              Dasbor

            </p>

          </a>

        </li>

        <li class="nav-item">

          <a href="{{ url('profile') }}" class="nav-link">
            
            <i class="nav-icon fas fa-home"></i>

            <p>

             Master Aplikasi

            </p>

          </a>

        </li>

        @if(Roles::canView('POS', $views))

          <li class="nav-item">

            <a href="{{ url('pos') }}" class="nav-link">

              <i class="nav-icon fas fa-cash-register"></i>

              <p>

                POS

              </p>

            </a>

          </li>

        @endif

        @if(Roles::canView('Cabang', $views) || Roles::canView('Produk Cabang', $views))

          <li class="nav-item has-treeview">

            <a href="#" class="nav-link">

              <i class="nav-icon fas fa-store"></i>

              <p>

                Master Cabang

                <i class="right fas fa-angle-left"></i>

              </p>

            </a>

            <ul class="nav nav-treeview">

              @if(Roles::canView('Cabang', $views))

                <li class="nav-item">

                  <a href="{{ url('branch') }}" class="nav-link">

                    <p>Cabang</p>

                  </a>

                </li>

              @endif

              @if(Roles::canView('Produk Cabang', $views))

                <li class="nav-item">

                  <a href="{{ url('branch/product') }}" class="nav-link">

                    <p>Produk Cabang</p>

                  </a>

                </li>

              @endif

            </ul>

          </li>

        @endif

        <li class="nav-item has-treeview">

          <a href="#" class="nav-link">

            <i class="nav-icon fas fa-envelope-open-text"></i>

            <p>

              Master Laporan

              <i class="right fas fa-angle-left"></i>

            </p>

          </a>

        </li>

        @if(Roles::canView('Riwayat Transaksi', $views) || Roles::canView('Diskon Produk', $views))

          <li class="nav-item has-treeview">

            <a href="#" class="nav-link">

              <i class="nav-icon fas fa-tags"></i>

              <p>

                Master Penjualan

                <i class="right fas fa-angle-left"></i>

              </p>

            </a>

            <ul class="nav nav-treeview">

              @if(Roles::canView('Riwayat Transaksi', $views))

                <li class="nav-item">

                  <a href="{{ url('transaction') }}" class="nav-link">

                    <p>Riwayat Transaksi</p>

                  </a>

                </li>

              @endif

              @if(Roles::canView('Diskon Produk', $views))

                <li class="nav-item">

                  <a href="{{ url('discount/product') }}" class="nav-link">

                    <p>Diskon Produk</p>

                  </a>

                </li>

              @endif

              {{-- <li class="nav-item">

                <a href="{{ url('discount') }}" class="nav-link">

                  <p>Data Diskon</p>

                </a>

              </li> --}}

            </ul>

          </li>

        @endif

        @if(Roles::canView('Produk', $views) || Roles::canView('Kategori', $views) || Roles::canView('Satuan', $views) || Roles::canView('Barcode', $views))

          <li class="nav-item has-treeview">

            <a href="#" class="nav-link">

              <i class="nav-icon fas fa-box-open"></i>

              <p>

                Master Produk

                <i class="right fas fa-angle-left"></i>

              </p>

            </a>

            <ul class="nav nav-treeview">

              @if(Roles::canView('Kategori', $views))

                <li class="nav-item">

                  <a href="{{ url('category') }}" class="nav-link">

                    <p>Kategori</p>

                  </a>

                </li>

              @endif

              @if(Roles::canView('Satuan', $views))

                <li class="nav-item">

                  <a href="{{ url('unit') }}" class="nav-link">

                    <p>Satuan</p>

                  </a>

                </li>

              @endif

              @if(Roles::canView('Produk', $views))

                <li class="nav-item">

                  <a href="{{ url('product') }}" class="nav-link">

                    <p>Produk</p>

                  </a>

                </li>

              @endif

              @if(Roles::canView('Barcode', $views))

                <li class="nav-item">

                  <a href="{{ url('barcode') }}" class="nav-link">

                    <p>Barcode</p>

                  </a>

                </li>
            
              @endif

            </ul>

          </li>

        @endif

        @if(Roles::canView('Penyuplai', $views) || Roles::canView('Data Barang', $views) || Roles::canView('Pembelian Barang', $views))

          <li class="nav-item has-treeview">

            <a href="#" class="nav-link">

              <i class="nav-icon fas fa-truck"></i>

              <p>

                Master Suplai

                <i class="right fas fa-angle-left"></i>

              </p>

            </a>

            <ul class="nav nav-treeview">

              @if(Roles::canView('Penyuplai', $views))

                <li class="nav-item">

                  <a href="{{ url('supplier') }}" class="nav-link">

                    <p>Penyuplai</p>

                  </a>

                </li>

              @endif  

              @if(Roles::canView('Data Barang', $views))

                <li class="nav-item">

                  <a href="{{ url('supplier/product') }}" class="nav-link">

                    <p>Barang</p>

                  </a>

                </li>

              @endif

              @if(Roles::canView('Pembelian Barang', $views))

                <li class="nav-item">

                  <a href="{{ url('supplier/purchasement') }}" class="nav-link">

                    <p>Pembelian Barang</p>

                  </a>

                </li>

              @endif

            </ul>

          </li>

        @endif

        {{-- @if(Session::get('owner')) --}}

          <li class="nav-item has-treeview">

            <a href="#" class="nav-link">

              <i class="nav-icon fas fa-user"></i>

              <p>

                Master User

                <i class="right fas fa-angle-left"></i>

              </p>

            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item">

                <a href="{{ url('user') }}" class="nav-link">

                  <i class="fas fa-user nav-icon"></i>

                  <p>User</p>

                </a>

              </li>

              <li class="nav-item">

                <a href="{{ url('role') }}" class="nav-link">

                  <i class="fas fa-user nav-icon"></i>

                  <p>Role</p>

                </a>

              </li>

            </ul>

          </li>

        {{-- @endif --}}

      </ul>

    </nav>
    <!-- /.sidebar-menu -->

  </div>
  <!-- /.sidebar -->

</aside>
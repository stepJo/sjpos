<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-indigo text-sm elevation-4">
  
  <!-- Brand Logo -->
  <a href="{{ url('dashboard') }}">

    <span class="font-weight-bold text-lg text-white mt-3 d-flex justify-content-center">SJPOS</span>

  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">

      <div class="info">

        <span class="text-warning">User : &nbsp;</span>

        <a href="">{{ Session::get('u_name') }}</a>

        <br/>

        <span class="text-warning">Email : &nbsp;</span>

        <a href="">{{ Session::get('u_email') }}</a>
      
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

          <a href="{{ url('pos') }}" class="nav-link">

            <i class="nav-icon fas fa-cash-register"></i>

            <p>

              POS

            </p>

          </a>

        </li>

        <li class="nav-item has-treeview">

          <a href="#" class="nav-link">

            <i class="nav-icon fas fa-tags"></i>

            <p>

              Master Penjualan

              <i class="right fas fa-angle-left"></i>

            </p>

          </a>

          <ul class="nav nav-treeview">

            <li class="nav-item">

              <a href="{{ url('transaction') }}" class="nav-link">

                <p>Riwayat Transaksi</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="{{ url('discount/product') }}" class="nav-link">

                <p>Diskon Produk</p>

              </a>

            </li>

            {{-- <li class="nav-item">

              <a href="{{ url('discount') }}" class="nav-link">

                <p>Data Diskon</p>

              </a>

            </li> --}}

          </ul>

        </li>

        <li class="nav-item has-treeview">

          <a href="#" class="nav-link">

            <i class="nav-icon fas fa-box-open"></i>

            <p>

              Master Produk

              <i class="right fas fa-angle-left"></i>

            </p>

          </a>

          <ul class="nav nav-treeview">

            <li class="nav-item">

              <a href="{{ url('category') }}" class="nav-link">

                <p>Data Kategori</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="{{ url('unit') }}" class="nav-link">

                <p>Data Satuan</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="{{ url('product') }}" class="nav-link">

                <p>Data Produk</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="{{ url('barcode') }}" class="nav-link">

                <p>Cetak Barcode</p>

              </a>

            </li>

          </ul>

        </li>

        <li class="nav-item has-treeview">

          <a href="#" class="nav-link">

            <i class="nav-icon fas fa-truck"></i>

            <p>

              Master Suplai

              <i class="right fas fa-angle-left"></i>

            </p>

          </a>

          <ul class="nav nav-treeview">

            <li class="nav-item">

              <a href="{{ url('supplier') }}" class="nav-link">

                <p>Data Penyuplai</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="{{ url('supplier/product') }}" class="nav-link">

                <p>Data Barang</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="{{ url('supplier/purchasement') }}" class="nav-link">

                <p>Pembelian Barang</p>

              </a>

            </li>

          </ul>

        </li>

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

              <a href="{{ url('role') }}" class="nav-link">

                <i class="fas fa-user nav-icon"></i>

                <p>Data Role</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="./index2.html" class="nav-link">

                <i class="fas fa-user nav-icon"></i>

                <p>Data Akses</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="./index3.html" class="nav-link">

                <i class="fas fa-box-open nav-icon"></i>

                <p>Data User</p>

              </a>

            </li>

          </ul>

        </li>

      </ul>

    </nav>
    <!-- /.sidebar-menu -->

  </div>
  <!-- /.sidebar -->

</aside>
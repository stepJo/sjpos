@extends('layouts.master')

@section('content')
	
	<body class="hold-transition sidebar-mini layout-fixed">
      
    	<div class="wrapper">

     		@include('layouts.top')

      		@include('layouts.sidebar')

	 		<!-- Content Wrapper. Contains page content -->
  			<div class="content-wrapper">
    
			<!-- Content Header (Page header) -->
    		@include('layouts.content_hd', ['title' => 'Data Produk'])
		    <!-- Main content -->
		    <section class="content">
      
      			<div class="row">

      				<div class="col-md-12">
        
	          			<div class="card">
	            
	            			<div class="card-header bg-light">
	              
	              				<h3 class="card-title">Produk <i class="fas fa-box-open ml-2"></i></h3>
	            				
	    					</div>
	        				<!-- /.card-header -->

	            			<div class="card-body">	

	            				<button class="button-s1 button-green">

	            					<a href="{{ url('product/create') }}" class="text-white">Tambah Produk</a>

	            				</button>
	              
	              				<table id="productTable" class="table table-hover">
	                		
	              					<div class="offset-md-12 d-flex justify-content-end mb-3">

	              						<a href="{{ route('product-csv') }}" target="_blank" class="button-s1 button-grey mr-2"><i class="fas fa-file-csv mr-1"></i> Expor CSV</a>

	              						<a href="{{ route('product-excel') }}" target="_blank" class="button-s1 button-darkgreen mr-2"><i class="fas fa-file-excel mr-1"></i> Expor Excel</a>

	              						<a href="{{ route('product-pdf') }}" target="_blank" class="button-s1 button-darkorange mr-2"><i class="fas fa-file-pdf mr-1"></i> Expor PDF</a>
	              						
	              					</div>

	                				<thead>
	                
	                					<tr>
	                  				
	                						<th>Kode</th>

	                						<th>Kategori</th>

	                  						<th>Nama</th>

	                  						<th>Satuan</th>

	                  						<th>Harga</th>

	                  						<th>Gambar</th>

	                  						<th>Status</th>

	                  						<th>Aksi</th>

	                					</tr>
	                	
	                				</thead>
	                
	                				<tbody>

						            </tbody>

	              				</table>

				            </div>
				            <!-- /.card-body -->

			            </div>
			            <!-- /.card -->

			        </div>

		        </div>
		        <!-- /.col -->

		    </div>
		    <!-- /.row -->

	    </section>
	    <!-- /.content -->

	</div>
	<!-- /.content-wrapper -->

@endsection

@section('script')

	@include('layouts/scripts/datatable')

	@include('layouts/scripts/mproduct')

@endsection
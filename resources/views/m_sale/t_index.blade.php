@extends('layouts.master')

@section('content')
	
	<body class="hold-transition sidebar-mini layout-fixed">
      
    	<div class="wrapper">

     		@include('layouts.top')

      		@include('layouts.sidebar')

	 		<!-- Content Wrapper. Contains page content -->
  			<div class="content-wrapper">
    
			<!-- Content Header (Page header) -->
    		@include('layouts.content_hd', ['title' => 'Riwayat Transaksi'])
		    <!-- Main content -->
		    <section class="content">
      
      			<div class="row">

      				<div class="col-md-12">
        
	          			<div class="card">
	            
	            			<div class="card-header bg-light">
	              
	              				<h3 class="card-title">Transaksi <i class="fas fa-tags ml-2"></i></h3>
	            				
	    					</div>
	        				<!-- /.card-header -->

	            			<div class="card-body">	

	              				<table id="transactionTable" class="table table-hover">

	              					<div class="row mt-1 mb-2">

			            				<div class="col-md-4">

		              						<a href="{{ route('transaction-csv') }}" target="_blank" class="button-s1 button-grey mr-2"><i class="fas fa-file-csv mr-1"></i> Expor CSV</a>

		              						<a href="{{ route('transaction-excel') }}" target="_blank" class="button-s1 button-darkgreen mr-2"><i class="fas fa-file-excel mr-1"></i> Expor Excel</a>

		              						<a href="{{ route('transaction-pdf') }}" target="_blank" class="button-s1 button-darkorange mr-2"><i class="fas fa-file-pdf mr-1"></i> Expor PDF</a>
		              						
		              					</div>

		              					<form>

			              					<div class="col-md-3">

			              						<div class="form-group">

				            						<label for="start_date">Tanggal Awal</label>

													<input type="text" id="start_date" name="start_date" class="search-calendar ml-1">

												</div>

			              					</div>

			              					<div class="col-md-3">

			              						<div class="form-group">

				            						<label for="end_date">Tanggal Akhir</label>

													<input type="text" id="end_date" name="end_date" class="search-calendar ml-1">

												</div>

			              					</div>

			              					<div class="col-md-2 d-flex align-items-start">

			              						<button type="reset" class="btn button-outline button-outline-black mr-2">Reset</button>

			              						<button class="btn button-outline button-outline-blue" id="btn-search-trans">Cari</button>

			              					</div>	

			              				</form>

		              				</div>
	                	
	                				<thead>
	                
	                					<tr>
	                  				
	                						<th>Kode</th>

	                  						<th>Metode Bayar</th>

	                  						<th>Total</th>

	                  						<th>Pajak</th>

	                  						<th>Diskon</th>

	                  						<th>Tanggal</th>

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

	@include('layouts/scripts/msale')

@endsection
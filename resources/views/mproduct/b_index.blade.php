@extends('layouts.master')

@section('content')
	
	<body class="hold-transition sidebar-mini layout-fixed">
      
    	<div class="wrapper">

     		@include('layouts.top')

      		@include('layouts.sidebar')

	 		<!-- Content Wrapper. Contains page content -->
  			<div class="content-wrapper">
    
			<!-- Content Header (Page header) -->
    		@include('layouts.title', ['title' => 'Cetak Barcode'])

		    <!-- Main content -->
		    <section class="content">
      
      			<div class="row">

      				<div class="col-md-12">
        
	          			<div class="card">
	            
	            			<div class="card-header bg-light">
	              
	              				<h3 class="card-title">Barcode <i class="fas fa-barcode ml-2"></i></h3>
	            				
	    					</div>
	        				<!-- /.card-header -->

	        				<div class="row">

	        					<div class="col-md-8">

			            			<div class="card-body">
			                    		
			            				<table id="barcodeTable" class="table table-hover">          

			                				<thead>
			                
			                					<tr>
			                  				
			                						<th>Kode</th>

			                  						<th>Nama</th>

			                  						<th>Barcode</th>

			                  						<th>Aksi</th>

			                					</tr>
			                	
			                				</thead>
			                
			                				<tbody>

								            </tbody>

			              				</table>

						            </div>
						            <!-- /.card-body -->

					        	</div>

					        	<div class=" col-md-4">

					        		<div class="card-body">

					        			<div class="form-group">

						        			<label for="p_name">Nama Produk</label>

						        			<input type="text" id="p_name" class="form-control" disabled>

						        		</div>

						        		<div class="form-group">

						        			<label for="p_code">Kode Produk</label>

						        			<input type="text" id="p_code" class="form-control" disabled>

						        		</div>

						        		<div class="form-group">

						        			<label for="total">Jumlah Barcode</label>

						        			<input type="text" id="total" class="form-control" value="">

						        		</div>

										<button id="button-print" class="button-s1 button-brown">Cetak</button>
										
										<a href="{{ url('product') }}" class="button-s1 button-grey mt-5">Kembali</a>

					        		</div>

					        	</div>

					        </div>

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

	@include('scripts/mproduct')

@endsection
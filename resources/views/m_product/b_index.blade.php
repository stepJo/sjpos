@extends('layouts.master')

@section('content')
	
	<body class="hold-transition sidebar-mini layout-fixed">
      
    	<div class="wrapper">

     		@include('layouts.top')

      		@include('layouts.sidebar')

	 		<!-- Content Wrapper. Contains page content -->
  			<div class="content-wrapper">
    
			<!-- Content Header (Page header) -->
    		@include('layouts.content_hd', ['title' => 'Cetak Barcode'])

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
			                    		
			            				<table id="masterTable" class="table table-hover">          

			                				<thead>
			                
			                					<tr>
			                  				
			                						<th>Kode Produk</th>

			                  						<th>Nama Produk</th>

			                  						<th>Barcode</th>

			                  						<th>Aksi</th>

			                					</tr>
			                	
			                				</thead>
			                
			                				<tbody>

			                					@foreach($products as $product)

									                <tr>

									                	<td>{{ $product->p_code }}</td>

									                  	<td>{{ $product->p_name }}</td>

									                  	<td>

									                  		<div id="print-side{{ $product->p_id }}">

									                  			{!! DNS1D::getBarcodeSVG($product->p_code, 'I25+') !!}

									                  		</div>

									                  	</td>

									                  	<td>

									                  		<button id="{{ $product->p_id }}" class="button-select-item button-s1 button-purple"><i class="fas fa-print mr-1"></i> Cetak Barcode</button>		
									              
									                  	</td>

									                </tr>

									            @endforeach

								            </tbody>

			              				</table>

			              				<a href="{{ url('product') }}" class="btn btn-default mt-3">Kembali</a>

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

	@include('layouts/scripts/datatable')

	@include('layouts/scripts/mproduct')

@endsection
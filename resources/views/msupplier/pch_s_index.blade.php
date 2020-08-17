@extends('layouts.master')

@section('content')
	
	<body class="hold-transition sidebar-mini layout-fixed">
      
    	<div class="wrapper">

     		@include('layouts.top')

      		@include('layouts.sidebar')

	 		<!-- Content Wrapper. Contains page content -->
  			<div class="content-wrapper">
    
			<!-- Content Header (Page header) -->
    		@include('layouts.content_hd', ['title' =>  'Data Pembelian Barang'])
		    <!-- Main content -->
		    <section class="content">
      
      			<div class="row">

      				<div class="col-md-12">
        
	          			<div class="card">
	            
	            			<div class="card-header bg-light">
	              
	              				<h3 class="card-title">Pembelian Barang <i class="nav-icon fas fa-truck ml-2"></i></h3>
	            				
	    					</div>
	        				<!-- /.card-header -->

	            			<div class="card-body">	

                                <div class="row mt-1">

                                    <div class="col-md-4">

                                        <button class="button-s1 button-green">

                                            <a href="{{ url('supplier/purchasement/create') }}" class="text-white">Tambah Pembelian Barang</a>
        
                                        </button>

                                    </div>

                                </div>

	              				<table id="purchasementSupplierTable" class="table table-hover">

                                    <div class="row my-3">

                                        <div class="col-md-4">
    
                                            <a href="{{ route('purchasement-supplier-csv') }}" target="_blank" class="button-s1 button-grey mr-2"><i class="fas fa-file-csv mr-1"></i> Expor CSV</a>
    
                                            <a href="{{ route('purchasement-supplier-excel') }}" target="_blank" class="button-s1 button-darkgreen mr-2"><i class="fas fa-file-excel mr-1"></i> Expor Excel</a>
											
                                            <a href="{{ route('purchasement-supplier-pdf') }}" target="_blank" class="button-s1 button-darkorange mr-2"><i class="fas fa-file-pdf mr-1"></i> Expor PDF</a>
                                            
										</div>
										
                                    </div>

									<div class="row mt-5">

                                        <form class="form-inline">
    
                                            <div class="col-md-3">
    
                                                <div class="form-group">
    
                                                    <label for="start_date">Tanggal Awal</label>
    
                                                    <input type="text" id="start_date" name="start_date" placeholder="Tanggal Awal" class="search-calendar ml-1">
    
                                                </div>
    
                                            </div>
    
                                            <div class="col-md-3">
    
                                                <div class="form-group">
    
                                                    <label for="end_date">Tanggal Akhir</label>
    
                                                    <input type="text" id="end_date" name="end_date" placeholder="Tanggal Akhir" class="search-calendar ml-1">
    
                                                </div>
    
											</div>
											
											<div class="col-md-3">
    
                                                <div class="form-group">

													<select class="select2bs4" style="width: 100%;" id="supplier" name="supplier">

														<option value="" selected>- Penyuplai -</option>
														
														<option value="*">Semua</option>

														@foreach($suppliers as $supplier)
	
															<option value="{{ $supplier->s_id }}">{{ $supplier->s_name }}</option>
	
														@endforeach
	
													</select>
													
                                                </div>
    
                                            </div>

                                            <div class="col-md-3">
    
                                                <button type="reset" class="btn button-outline button-outline-black mr-2">Reset</button>
    
                                                <button class="btn button-outline button-outline-blue" id="btn-search-pchsupp">Cari</button>
    
                                            </div>	
    
                                        </form>
    
                                    </div>

	                				<thead>
	                
	                					<tr>
	                  				
	                						<th>Kode</th>

	                						<th>Biaya</th>

	                  						<th>Tanggal</th>

											<th>Penyuplai</th>
											
											<th>Catatan</th>

	                  						<th>Aksi</th>

	                					</tr>
	                	
	                				</thead>
	                
	                				<tbody>

									</tbody>

									<tfoot>

										<tr>

											<th colspan="6"></th>

										</tr>
										
									</tfoot>

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

	@include('layouts/scripts/msupplier')

@endsection
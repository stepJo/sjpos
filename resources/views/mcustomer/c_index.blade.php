@extends('layouts.master')

@section('content')
	
	<body class="hold-transition sidebar-mini layout-fixed">
      
    	<div class="wrapper">

     		@include('layouts.top')

      		@include('layouts.sidebar')

	 		<!-- Content Wrapper. Contains page content -->
  			<div class="content-wrapper">
    
			<!-- Content Header (Page header) -->
    		@include('layouts.title', ['title' => 'Data Pelanggan'])

		    <!-- Main content -->
		    <section class="content">
      
      			<div class="row">

      				<div class="col-md-12">
        
	          			<div class="card">
	            
	            			<div class="card-header bg-light">
	              
	              				<h3 class="card-title">Pelanggan <i class="nav-icon far fa-grin ml-2"></i></h3>
	            				
	    					</div>
	        				<!-- /.card-header -->

	            			<div class="card-body">
	              
	              				<table id="customerTable" class="table table-hover">
									
									@if($access->add == 1)

										<button class="button-s1 button-green mb-4" data-toggle="modal" data-target="#addModal">
							
											Tambah Pelanggan

										</button>

										<div class="modal fade" id="addModal">
											
											<div class="modal-dialog">

											<div class="modal-content">

												<div class="modal-header">

													<h4 class="modal-title">Tambah Pelanggan <i class="nav-icon far fa-grin ml-2"></i></h4>

													<button type="button" class="close" data-dismiss="modal" aria-label="Close">

														<span aria-hidden="true">&times;</span>
													
													</button>
														
													</div>

													<form id="add-customer-form">

														<div class="modal-body">
															
															<p class="text-secondary font-weight-bold">[*] Wajib Diisi</p>

															<div class="row">

																<div class="col-md-12">

																	<div class="form-group">

																		<label class="modal-label">Nama *</label>

																		<br/>

																		<span class="text-danger add-c-name-error"></span>

																		<input 
																			type="text" 
																			name="c_name" 
																			class="modal-input add-c-name-modal-error" 
																			placeholder="Nama Pelanggan"
																		>

																	</div>

																</div>

																<div class="col-md-12">

																	<div class="form-group">

																		<label class="modal-label">Email</label>

																		<br/>

																		<span class="text-danger add-c-email-error"></span>

																		<input 
																			type="text" 
																			name="c_email" 
																			class="modal-input add-c-email-modal-error" 
																			placeholder="Email Pelanggan"
																		>

																	</div>

																</div>

																<div class="col-md-12">

																	<div class="form-group">

																		<label class="modal-label">Kontak</label>

																		<br/>

																		<span class="text-danger add-c-contact-error"></span>

																		<input 
																			type="text" 
																			name="c_contact" 
																			class="modal-input add-c-contact-modal-error" 
																			placeholder="Kontak Pelanggan"
																		>

																	</div> 	

																</div>

																<div class="col-md-12">

																	<div class="form-group">

																		<label class="modal-label">Alamat</label>

																		<br/>

																		<span class="text-danger add-c-address-error"></span>

																		<textarea class="textarea-input add-c-address-modal-error" placeholder="Alamat Pelanggan" name="c_address"></textarea>
																
																	</div>

																</div>

															</div>	
												
														</div>
													
														<div class="modal-footer justify-content-between">
													
															<button type="button" class="button-s1 button-grey" data-dismiss="modal">Batal</button>
													
															<button type="submit" class="button-s1 button-green">Simpan</button>
														
														</div>

													</form>
											
												</div>
												<!-- /.modal-content -->
											
											</div>
											<!-- /.modal-dialog -->
										
										</div>
										<!-- /.modal -->
									
									@endif
									
									<div class="offset-md-12 d-flex justify-content-end mb-3">

										<a href="{{ route('customer-csv') }}" target="_blank" class="button-s1 button-grey mr-2"><i class="fas fa-file-csv mr-1"></i> Expor CSV</a>

										<a href="{{ route('customer-excel') }}" target="_blank" class="button-s1 button-darkgreen mr-2"><i class="fas fa-file-excel mr-1"></i> Expor Excel</a>

										<a href="{{ route('customer-pdf') }}" target="_blank" class="button-s1 button-darkorange mr-2"><i class="fas fa-file-pdf mr-1"></i> Expor PDF</a>
										
									</div>

	                				<thead>
	                
	                					<tr>
	                  				
	                						<th>Nama</th>

	                  						<th>Email</th>

	                  						<th>Kontak</th>

	                  						<th>Alamat</th>

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

	@include('scripts/mcustomer')

@endsection
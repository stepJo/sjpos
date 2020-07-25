@extends('layouts.master')

@section('content')
	
	<body class="hold-transition sidebar-mini layout-fixed">
      
    	<div class="wrapper">

     		@include('layouts.top')

      		@include('layouts.sidebar')

	 		<!-- Content Wrapper. Contains page content -->
  			<div class="content-wrapper">
    
			<!-- Content Header (Page header) -->
    		@include('layouts.content_hd', ['title' => 'Data Penyuplai'])

		    <!-- Main content -->
		    <section class="content">
      
      			<div class="row">

      				<div class="col-md-12">
        
	          			<div class="card">
	            
	            			<div class="card-header bg-light">
	              
	              				<h3 class="card-title">Penyuplai <i class="fas fa-box-open ml-2"></i></h3>
	            				
	    					</div>
	        				<!-- /.card-header -->

	            			<div class="card-body">
	              
	              				<table id="masterTable" class="table table-hover">
	                		
	              					<button class="button-s1 button-green mb-4" data-toggle="modal" data-target="#addModal">
    					
				    					Tambah Penyuplai

				    				</button>

				    				<div class="modal fade" id="addModal">
								        
								        <div class="modal-dialog modal-lg">

								          <div class="modal-content">

								            <div class="modal-header">

								              	<h4 class="modal-title">Tambah Penyuplai <i class="fas fa-box-open ml-2"></i></h4>

							              		<button type="button" class="close" data-dismiss="modal" aria-label="Close">

							                		<span aria-hidden="true">&times;</span>
							              		
							              		</button>
								            		
								            	</div>

								            	<form id="add-supplier-form">

								            		@csrf

							            			<div class="modal-body">
								              			
								              			<p class="text-secondary font-weight-bold">[*] Wajib Diisi</p>

								              			<div class="row">

								              				<div class="col-md-6">

										              			<div class="form-group">

												                  	<label class="modal-label">Kode *</label>

											                  		<br/>

											                  		<span class="text-danger add-s-code-error"></span>

											                  		<input 
											                  			type="text" 
											                  			name="s_code" 
											                  			class="modal-input add-s-code-modal-error" 
											                  			placeholder="Kode Penyuplai"
											                  		>

												                </div>

												            </div>

								              				<div class="col-md-6">

										              			<div class="form-group">

												                  	<label class="modal-label">Nama *</label>

											                  		<br/>

											                  		<span class="text-danger add-s-name-error"></span>

											                  		<input 
											                  			type="text" 
											                  			name="s_name" 
											                  			class="modal-input add-s-name-modal-error" 
											                  			placeholder="Nama Penyuplai"
											                  		>

												                </div>

												            </div>

												            <div class="col-md-6">

												            	<div class="form-group">

												                  	<label class="modal-label">Email</label>

											                  		<br/>

											                  		<span class="text-danger add-s-email-error"></span>

											                  		<input 
											                  			type="text" 
											                  			name="s_email" 
											                  			class="modal-input add-s-email-modal-error" 
											                  			placeholder="Email Penyuplai"
											                  		>

												                </div>

												            </div>

												            <div class="col-md-6">

												            	<div class="form-group">

												                  	<label class="modal-label">Kontak *</label>

											                  		<br/>

											                  		<span class="text-danger add-s-contact-error"></span>

											                  		<input 
											                  			type="text" 
											                  			name="s_contact" 
											                  			class="modal-input add-s-contact-modal-error" 
											                  			placeholder="Kontak Penyuplai"
											                  		>

												                </div> 	

												            </div>

												            <div class="col-md-6">

												            	<div class="form-group">

												                  	<label class="modal-label">Bank</label>

											                  		<br/>

											                  		<span class="text-danger add-s-bank-error"></span>

											                  		<input 
											                  			type="text" 
											                  			name="s_bank" 
											                  			class="modal-input add-s-bank-modal-error" 
											                  			placeholder="Bank Penyuplai"
											                  			value="{{ old('s_bank') }}"
											                  		>

												                </div>

												            </div>

												            <div class="col-md-6">

												            	<div class="form-group">

												                  	<label class="modal-label">Rekening</label>

											                  		<br/>

											                  		<span class="text-danger add-s-bank-num-error"></span>

											                  		<input 
											                  			type="text" 
											                  			name="s_bank_num" 
											                  			class="modal-input add-s-bank-num-modal-error" 
											                  			placeholder="Rekening Penyuplai"
											                  		>

												                </div> 

												            </div>

												            <div class="col-md-6">

								            					<div class="form-group">

								            						<label for="s_address">Alamat</label>

								            						<br/>

											                  		<span class="text-danger add-s-address-error"></span>

																  	<textarea class="textarea-input add-s-address-modal-error" placeholder="Alamat Penyuplai" name="s_address"></textarea>
															
						          								</div>

								            				</div>

											            </div>	
								            
								            		</div>
									            
									            	<div class="modal-footer justify-content-between">
									              
									              		<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
									              
								              			<button type="submit" class="btn btn-success">Simpan</button>
									            	
									            	</div>

									            </form>
								          
								          	</div>
								          	<!-- /.modal-content -->
								        
								        </div>
								        <!-- /.modal-dialog -->
								      
								    </div>
								    <!-- /.modal -->

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

	                					@foreach($suppliers as $supplier)

							                <tr data-id="{{ $supplier->s_id }}">

							                  	<td>{{ $supplier->s_name }}</td>

							                  	<td>{{ Utilities::emptyFormat($supplier->s_email) }}</td>

							                  	<td>{{ $supplier->s_contact }}</td>

							                  	<td>{{ Utilities::emptyFormat($supplier->s_address) }}</td>

							                  	<td class="actions">
							                  		
							                  		<div class="dropdown">
                            
							                            <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

							                                Aksi
							                            
							                            </button>

							                            <div class="dropdown-menu mr-5" aria-labelledby="dropdownMenuLink">
							                            
							                                <a class="dropdown-item text-info" data-toggle="modal" data-target="#detModal{{ $supplier->s_id }}">

							                                    <i class="fas fa-info-circle mr-1"></i> Detail

							                                </a>
							                            
							                                <a class="dropdown-item text-warning" data-toggle="modal" data-target="#editModal{{ $supplier->s_id }}">

							                                    <i class="fas fa-edit mr-1"></i> Edit

							                                </a>
							                            
							                                <a class="dropdown-item text-danger" data-toggle="modal" data-target="#delModal{{ $supplier->s_id }}">

							                                    <i class="fas fa-trash mr-1"></i> Delete

							                                </a>
							                            
							                            </div>

							                        </div>

							                        <div class="modal fade" id="detModal{{ $supplier->s_id }}">
								        
												        <div class="modal-dialog">

												          	<div class="modal-content">

												            	<div class="modal-header">

												              		<h4 class="modal-title">Detail Penyuplai <i class="fas fa-box-open ml-2"></i></h4>

										              				<button type="button" class="close" data-dismiss="modal" aria-label="Close">

										                				<span aria-hidden="true">&times;</span>
										              		
										              				</button>
												            		
											            		</div>

										            			<div class="modal-body">

										            				<p>Kode : <span class="ml-1 font-weight-bold">{{ $supplier->s_code }}</span></p>

										            				<p>Nama : <span class="ml-1 font-weight-bold">{{ $supplier->s_name }}</span></p>
											              
										            				<p>Email : <span class="ml-1 font-weight-bold">{{ Utilities::emptyFormat($supplier->s_email) }}</span></p>

										            				<p>Kontak : <span class="ml-1 font-weight-bold">{{ $supplier->s_contact }}</span></p>

											            			<p>Bank : <span class="ml-1 font-weight-bold">{{ Utilities::emptyFormat($supplier->s_bank) }}</span></p>

											            			<p>Rekekening : <span class="ml-1 font-weight-bold">{{ Utilities::emptyFormat($supplier->s_bank_num) }}</span></p>

											            			<p>Alamat : <span class="ml-1 font-weight-bold">{{ Utilities::emptyFormat($supplier->s_address) }}</span></p>

											            		</div>

												          	</div>
												          	<!-- /.modal-content -->
												        
												        </div>
												        <!-- /.modal-dialog -->
												      
												    </div>
												    <!-- /.modal -->

							                  		<div class="modal fade" id="editModal{{ $supplier->s_id }}">
								        
												        <div class="modal-dialog modal-lg">

												          <div class="modal-content">

												            <div class="modal-header">

												              	<h4 class="modal-title">Edit Supplier</h4>

											              		<button type="button" class="close" data-dismiss="modal" aria-label="Close">

											                		<span aria-hidden="true">&times;</span>
											              		
											              		</button>
												            		
												            	</div>

												            	<form class="edit-supplier-form" data-id="{{ $supplier->s_id }}">

												            		@method('PATCH')

												            		@csrf

											            			<div class="modal-body">

											            				<p class="text-secondary font-weight-bold">[*] Wajib Diisi</p>

											            				<div class="row">

												              				<div class="col-md-6">

														              			<div class="form-group">

																                  	<label class="modal-label">Kode *</label>

															                  		<br/>

															                  		<span class="text-danger edit-s-code-error"></span>

															                  		<input 
															                  			type="text" 
															                  			name="s_code" 
															                  			class="modal-input edit-s-code-modal-error" 
															                  			value="{{ $supplier->s_code }}"
															                  		>

																                </div>

																            </div>

												              				<div class="col-md-6">

														              			<div class="form-group">

																                  	<label class="modal-label">Nama *</label>

															                  		<br/>

															                  		<span class="text-danger edit-s-name-error"></span>

															                  		<input 
															                  			type="text" 
															                  			name="s_name" 
															                  			class="modal-input edit-s-name-modal-error" 
															                  			value="{{ $supplier->s_name }}"
															                  		>

																                </div>

																            </div>

																            <div class="col-md-6">

																            	<div class="form-group">

																                  	<label class="modal-label">Email</label>

															                  		<br/>

															                  		<span class="text-danger edit-s-email-error"></span>

															                  		<input 
															                  			type="text" 
															                  			name="s_email" 
															                  			class="modal-input edit-s-email-modal-error" 
															                  			value="{{ $supplier->s_email }}"
															                  		>

																                </div>

																            </div>

																            <div class="col-md-6">

																            	<div class="form-group">

																                  	<label class="modal-label">Kontak *</label>

															                  		<br/>

															                  		<span class="text-danger edit-s-contact-error"></span>

															                  		<input 
															                  			type="text" 
															                  			name="s_contact" 
															                  			class="modal-input edit-s-contact-modal-error" 
															                  			value="{{ $supplier->s_contact }}"
															                  		>

																                </div> 	

																            </div>

																            <div class="col-md-6">

																            	<div class="form-group">

																                  	<label class="modal-label">Bank</label>

																                  		<br/>

																                  		<span class="text-danger edit-s-banke-error"></span>

															                  		<input 
															                  			type="text" 
															                  			name="s_bank" 
															                  			class="modal-input edit-s-bank-modal-error" 
															                  			value="{{ $supplier->s_bank }}"
															                  		>

																                </div>

																            </div>

																            <div class="col-md-6">

																            	<div class="form-group">

																                  	<label class="modal-label">Rekening</label>

															                  		<br/>

															                  		<span class="text-danger edit-s-bank-num-error"></span>

															                  		<input 
															                  			type="text" 
															                  			name="s_bank_num" 
															                  			class="modal-input edit-s-bank-num-modal-error" 
															                  			value="{{ $supplier->s_bank_num }}"
															                  		>

																                </div> 

																            </div>

																            <div class="col-md-6">

												            					<div class="form-group">

												            						<label for="s_address">Alamat</label>

												            						<br/>

															                  		<span class="text-danger edit-s-address-error"></span>

																				  	<textarea class="textarea-input edit-s-address-modal-error" placeholder="Alamat Penyuplai" name="s_address">{{ $supplier->s_address }}</textarea>
																			
										          								</div>

												            				</div>

															            </div>		
												              
												            		</div>
													            
													            	<div class="modal-footer justify-content-between">
													              
													              		<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
													              
												              			<button type="submit" class="btn btn-warning">Ubah</button>
													            	
													            	</div>

													            </form>
												          
												          	</div>
												          	<!-- /.modal-content -->
												        
												        </div>
												        <!-- /.modal-dialog -->
												      
												    </div>
												    <!-- /.modal -->

							                  		<div class="modal fade" id="delModal{{ $supplier->s_id }}">
								        
												        <div class="modal-dialog">

												          <div class="modal-content">

												            <div class="modal-header">

												              	<h4 class="modal-title">Hapus Supplier</h4>

											              		<button type="button" class="close" data-dismiss="modal" aria-label="Close">

											                		<span aria-hidden="true">&times;</span>
											              		
											              		</button>
												            		
												            	</div>

												            	<form action="{{ route('supplier.destroy', $supplier->s_id) }}" method="POST">

												            		@method('DELETE')

												            		@csrf

											            			<div class="modal-body">
												              	
												              			Yakin ingin menghapus Penyuplai <b>{{ $supplier->s_name }}</b> ?
												            
												            		</div>
													            
													            	<div class="modal-footer justify-content-between">
													              
													              		<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
													              
												              			<button type="submit" class="btn btn-danger">Hapus</button>
													            	
													            	</div>

													            </form>
												          
												          	</div>
												          	<!-- /.modal-content -->
												        
												        </div>
												        <!-- /.modal-dialog -->
												      
												    </div>
												    <!-- /.modal -->

							                  	</td>

							                </tr>

							            @endforeach

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
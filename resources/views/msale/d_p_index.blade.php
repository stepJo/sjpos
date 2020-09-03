@extends('layouts.master')

@section('content')
	
	<body class="hold-transition sidebar-mini layout-fixed">
      
    	<div class="wrapper">

     		@include('layouts.top')

      		@include('layouts.sidebar')

	 		<!-- Content Wrapper. Contains page content -->
  			<div class="content-wrapper">
    
			<!-- Content Header (Page header) -->
    		@include('layouts.title', ['title' => 'Diskon Produk'])

		    <!-- Main content -->
		    <section class="content">
      
      			<div class="row">

      				<div class="col-md-12">
        
	          			<div class="card">
	            
	            			<div class="card-header bg-light">
	              
	              				<h3 class="card-title">Diskon Produk <i class="fas fa-tags ml-2"></i></h3>
	            				
	    					</div>
	        				<!-- /.card-header -->

	            			<div class="card-body">
	              
	              				<table id="masterTable" class="table table-hover">
	                		
	              					<button class="button-s1 button-green mb-4" data-toggle="modal" data-target="#addModal">
    					
				    					Tambah Diskon

				    				</button>

				    				<div class="modal fade" id="addModal">
								        
								        <div class="modal-dialog modal-lg">

								          <div class="modal-content">

								            <div class="modal-header">

								              	<h4 class="modal-title">Tambah Diskon <i class="fas fa-tags ml-2"></i></h4>

							              		<button type="button" class="close" data-dismiss="modal" aria-label="Close">

							                		<span aria-hidden="true">&times;</span>
							              		
							              		</button>
								            		
								            	</div>

								            	<form id="add-discount-product-form">

								            		@csrf

							            			<div class="modal-body">
								              			
								              			<p class="text-secondary font-weight-bold">[*] Wajib Diisi</p>

								              			<div class="row">

															<div class="col-md-12">

																<div class="form-group">

																	<label class="modal-label">Cari Produk</label>

												                	<div class="searchBar">
								   	
															  	 		<input class="searchInput" type="text" placeholder="Cari Produk (Nama / Kode) ..." />
																    
															    		<button class="searchSubmit" type="submit"	>
															      
															      			<svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#666666" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" />
															      			
															      			</svg>
															   
															   	 		</button>

																 	</div>
												                	
												                </div>

															</div>

														</div>

														<div class="row">

															<div class="col-md-4">

										              			<div class="form-group">

												                  	<label class="modal-label">ID Produk *</label>

											                  		<br/>

											                  		<span class="text-danger add-p-id-error"></span>

											                  		<input 
											                  			type="text" 
											                  			id="p_id"
											                  			class="modal-input add-p-id-modal-error" 
											                  			placeholder="..."
											                  			value=""
											                  			disabled
											                  			style="background: #f5f5f5 !important;" 
											                  		>

											                  		<input type="hidden" name="p_id">

												                </div>
															
															</div>

															<div class="col-md-4">

										              			<div class="form-group">

												                  	<label class="modal-label">Nilai *</label>

											                  		<br/>

											                  		<span class="text-danger add-dp-value-error"></span>

											                  		<input 
											                  			type="text" 
											                  			name="dp_value" 
											                  			class="modal-input add-dp-value-modal-error" 
											                  			placeholder="Nilai Diskon"
											                  		>

												                </div>
															
															</div>

															<div class="col-md-4">

								            					<div class="form-group">

								            						<label for="dp_status" class="modal-label">Status *</label>

							            							<br>

											                  		<span class="text-danger add-dp-status-error"></span>

								            						<select class="form-control modal-input add-dp-status-modal-error" style="width: 100%;" name="dp_status">

											                        	<option value="" class="font-weight-bold" selected>- Status Diskon -</option>

										                          		<option value="1" class="font-italic font-weight-bold text-success">Aktif</option>

										                          		<option value="0" class="font-italic font-weight-bold text-danger">Tidak Aktif</option>

											                        </select>

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

	                				<thead>
	                
	                					<tr>

	                  						<th>Produk</th>

	                  						<th>Harga</th>

	                  						<th>Diskon</th>

	                  						<th>Jual</th>

	                  						<th>Status</th>

	                  						<th>Aksi</th>

	                					</tr>
	                	
	                				</thead>
	                
	                				<tbody>

	                					@foreach($discounts as $discount)

							                <tr>

							                	<td>{{ $discount->product->p_name }}</td>

							                	<td>{{ Utilities::rupiahFormat($discount->product->p_price) }}</td>

							                  	<td>{{ Utilities::rupiahFormat($discount->dp_value) }}</td>

							                  	<td>{{ Utilities::rupiahFormat($discount->product->p_price - $discount->dp_value) }}</td>

							                  	<td>
							                  		
							                  		{!! Utilities::statusFormat($discount->dp_status) !!}

							                  	</td>

							                  	<td>
							                  		
							                  		<button class="button-s1 button-yellow" data-toggle="modal" data-target="#editModal{{ $discount->dp_id }}">

							                  			<i class="fas fa-marker mr-1"></i> Edit

							                  		</button>

							                  		<div class="modal fade" id="editModal{{ $discount->dp_id }}">
								        
												        <div class="modal-dialog modal-lg">

												          <div class="modal-content">

												            <div class="modal-header">

												              	<h4 class="modal-title">Edit Diskon <i class="fas fa-tags ml-2"></i></h4>

											              		<button type="button" class="close" data-dismiss="modal" aria-label="Close">

											                		<span aria-hidden="true">&times;</span>
											              		
											              		</button>
												            		
												            	</div>

												            	<form class="edit-discount-product-form" data-id="{{ $discount->dp_id }}">

												            		@method('PATCH')

												            		@csrf

											            			<div class="modal-body">

											            				<p class="text-secondary font-weight-bold">[*] Wajib Diisi</p>	

											            				<div class="row">

												            				<div class="col-md-12">

																				<div class="form-group">

																					<label class="modal-label">Cari Produk</label>

																                	<div class="searchBar">
												   	
																			  	 		<input id="discountProductInput" class="searchInput" type="text" placeholder="Cari Produk (Nama / Kode) ..." />
																				    
																			    		<button class="searchSubmit" type="submit">
																			      
																			      			<svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#666666" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" />
																			      			
																			      			</svg>
																			   
																			   	 		</button>

																				 	</div>
																                	
																                </div>

																			</div>

																		</div>
												              			
												              			<div class="row">

																			<div class="col-md-4">

														              			<div class="form-group">

																                  	<label class="modal-label">ID Produk *</label>

															                  		<br/>

															                  		<span class="text-danger edit-p-id-error"></span>

															                  		<input 
															                  			id="p_id"
															                  			type="text" 
															                  			class="modal-input edit-p-id-modal-error" 
															                  			placeholder="..."
															                  			value="{{ $discount->product->p_id }}"
															                  			disabled
															                  			style="background: #f5f5f5 !important;" 
															                  		>

															                  		<input type="hidden" name="p_id" value="{{ $discount->product->p_id }}">

																                </div>
																			
																			</div>

																			<div class="col-md-4">

														              			<div class="form-group">

																                  	<label class="modal-label">Nilai *</label>

															                  		<br/>

															                  		<span class="text-danger edit-dp-value-error"></span>

															                  		<input 
															                  			type="text" 
															                  			name="dp_value" 
															                  			class="modal-input edit-dp-value-modal-error" 
															                  			value="{{ $discount->dp_value }}"
															                  		>

																                </div>
																			
																			</div>

																			<div class="col-md-4">

												            					<div class="form-group">

												            						<label for="dp_status" class="modal-label">Status *</label>

											            							<br>

															                  		<span class="text-danger edit-dp-status-error"></span>

												            						<select class="custom-select edit-dp-status-modal-error" name="dp_status">

												            							@if($discount->dp_status == 1)

															                          		<option value="1" class="font-italic font-weight-bold text-success" selected>Aktif</option>

															                          		<option value="0" class="font-italic font-weight-bold text-danger">Tidak Aktif</option>

															                          	@else

															                          		<option value="1" class="font-italic font-weight-bold 	text-success" selected>Aktif</option>

															                          		<option value="0" class="font-italic font-weight-bold text-danger" selected>Tidak Aktif</option>

															                          	@endif

															                        </select>

												            					</div>

												            				</div>

																		</div>
												            
												            		</div>
													            
													            	<div class="modal-footer justify-content-between">
													              
													              		<button type="button" class="button-s1 button-grey" data-dismiss="modal">Batal</button>
													              
												              			<button type="submit" class="button-s1 button-yellow">Ubah</button>
													            	
													            	</div>

													            </form>
												          
												          	</div>
												          	<!-- /.modal-content -->
												        
												        </div>
												        <!-- /.modal-dialog -->
												      
												    </div>
												    <!-- /.modal -->

												    <button class="button-s1 button-red" data-toggle="modal" data-target="#delModal{{ $discount->dp_id }}">

							                  			<i class="fas fa-trash mr-1"></i> Hapus

							                  		</button>

							                  		<div class="modal fade" id="delModal{{ $discount->dp_id }}">
								        
												        <div class="modal-dialog">

												          <div class="modal-content">

												            <div class="modal-header">

												              	<h4 class="modal-title">Hapus Diskon <i class="fas fa-tags ml-2"></i></h4>

											              		<button type="button" class="close" data-dismiss="modal" aria-label="Close">

											                		<span aria-hidden="true">&times;</span>
											              		
											              		</button>
												            		
												            	</div>

												            	<form action="{{ route('discount-product.destroy', $discount->dp_id) }}" method="POST">

												            		@csrf

												            		@method('DELETE')

											            			<div class="modal-body">
												              	
												              			Yakin ingin menghapus diskon produk <b>{{ $discount->product->p_name }}</b> ?
												            
												            		</div>
													            
													            	<div class="modal-footer justify-content-between">
													              
													              		<button type="button" class="button-s1 button-grey" data-dismiss="modal">Batal</button>
													              
												              			<button type="submit" class="button-s1 button-red">Hapus</button>
													            	
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

	@include('scripts/msale')

@endsection
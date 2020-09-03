@extends('layouts.master')

@section('content')
	
	<body class="hold-transition sidebar-mini layout-fixed">
      
    	<div class="wrapper">

     		@include('layouts.top')

      		@include('layouts.sidebar')

	 		<!-- Content Wrapper. Contains page content -->
  			<div class="content-wrapper">
    
			<!-- Content Header (Page header) -->
    		@include('layouts.title', ['title' => 'Data Diskon'])

		    <!-- Main content -->
		    <section class="content">
      
      			<div class="row">

      				<div class="col-md-12">
        
	          			<div class="card">
	            
	            			<div class="card-header bg-light">
	              
	              				<h3 class="card-title">Diskon <i class="fas fa-tags ml-2"></i></h3>
	            				
	    					</div>
	        				<!-- /.card-header -->

	            			<div class="card-body">
	              
	              				<table id="masterTable" class="table">
	                			
				    				<div class="row">

				    					<div class="col-md-6">

				    						<button class="button button-green" data-toggle="modal" data-target="#addModal">
    					
						    					Tambah Diskon

						    				</button>

				    					</div>

					    				<div class="offset-md-4 col-md-2">

		            						<div class="form-group">

		            							<label for="dis_type" class="modal-label">Filter Diskon</label>

			            						<div class="modal-dropdown">
										        
										        	<div class="select">
										          
										          		<span>- Tipe Diskon -</span>
										        
										        	  	<i class="fa fa-chevron-left"></i>
										        
										        	</div>

										        	<input type="hidden" name="dis_type" id="dis_type">
										        
										        	<ul class="dropdown-menu" id="type-filter">

										        		<li id="*">*</li>
										          
										          		<li id="Fix">Fix</li>
										          
										          		<li id="Percent">Percent</li>
										        
										        	</ul>
										      
										      	</div>

											</div>

		            					</div>

		            				</div>

				    				<div class="modal" id="addModal">
								        
								        <div class="modal-dialog modal-lg">

								          	<div class="modal-content">

								            	<div class="modal-header">

								              		<h4 class="modal-title">Tambah Diskon <i class="fas fa-tags ml-2"></i></h4>

							              			<button type="button" class="close" data-dismiss="modal" aria-label="Close">

							                		<span aria-hidden="true">&times;</span>
							              		
							              			</button>
								            		
								            	</div>

								            	<form action="{{ route('discount.store') }}" method="POST" class="form">

								            		@csrf

							            			<div class="modal-body">

							            				<p class="text-secondary font-weight-bold">[*] Wajib Diisi</p>

							            				<button id="gen-code" class="button bg-indigo">Acak Kode</button>
								              		
							            				<div class="row">

							            					<div class="col-md-6">

							            						<div class="form-group">

								            						<label for="dis_code" class="modal-label">Kode *</label>
    																	
    																@error('dis_code')

												                  		<span class="text-danger"> {{ $message }}</span>

												                  	@enderror

    																<input type="text" id="dis_code" name="dis_code" value="{{ old('dis_code') }}" class="modal-input {{ $errors->has('dis_code') ? ' is-invalid' : '' }}" placeholder="Kode Diskon">

																</div>

							            					</div>

							            					<div class="col-md-6">

							            						<div class="form-group">

							            							<label for="dis_type" class="modal-label">Tipe *</label>

							            							@error('dis_type')

												                  		<span class="text-danger"> {{ $message }}</span>

												                  	@enderror

								            						<div class="modal-dropdown">
															        
															        	<div class="select {{ $errors->has('dis_type') ? ' is-invalid' : '' }}">
															          
															          		<span>- Tipe Diskon -</span>
															        
															        	  	<i class="fa fa-chevron-left"></i>
															        
															        	</div>
															        
															        	<input type="hidden" name="dis_type">
															        
															        	<ul class="dropdown-menu">
															          	
															          		<li id="Fix">Fix</li>
															          
															          		<li id="Percent">Percent</li>
															        
															        	</ul>
															      
															      	</div>

																</div>

							            					</div>

							            					<div class="col-md-6">

							            						<div class="form-group">

								            						<label for="min_trans" class="modal-label">Minimum</label>

								            						@error('min_trans')

												                  		<span class="text-danger"> {{ $message }}</span>

												                  	@enderror
    									
    																<input type="text" id="min_trans" name="min_trans" value="{{ old('min_trans') }}" class="modal-input {{ $errors->has('min_trans') ? ' is-invalid' : '' }}" placeholder="Pembayaran Minimum">

																</div>

							            					</div>

							            					<div class="col-md-6">

							            						<div class="form-group">

								            						<label for="dis_value" class="modal-label">Nilai *</label>
    										
								            						@error('dis_value')

												                  		<span class="text-danger"> {{ $message }}</span>

												                  	@enderror

    																<input type="text" id="dis_value" name="dis_value" value="{{ old('dis_value') }}" class="modal-input {{ $errors->has('dis_value') ? ' is-invalid' : '' }}" placeholder="Nilai Diskon">

																</div>

							            					</div>

							            					<div class="col-md-6">

							            						<div class="form-group">

								            						<label for="dis_qty" class="modal-label">Jumlah *</label>

								            						@error('dis_qty')

												                  		<span class="text-danger"> {{ $message }}</span>

												                  	@enderror
    									
    																<input type="number" id="dis_qty" name="dis_qty" value="{{ old('dis_qty') }}" class="modal-input {{ $errors->has('dis_qty') ? ' is-invalid' : '' }}" placeholder="Jumlah Diskon">

																</div>

							            					</div>

							            					<div class="col-md-6">

							            						<div class="form-group">

								            						<label for="exp_date" class="modal-label">Kadaluarsa *</label>
    										
								            						@error('exp_date')

												                  		<span class="text-danger"> {{ $message }}</span>

												                  	@enderror

    																<input type="text" id="exp_date" name="exp_date" value="{{ old('exp_date') }}" class="calendar modal-input {{ $errors->has('exp_date') ? ' is-invalid' : '' }}" placeholder="Tanggal Kadaluarsa">

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

	                  						<th>Kode</th>

	                  						<th>Tipe</th>

	                  						<th>Minimum Transaksi</th>

	                  						<th>Nilai</th>

	                  						<th>Jumlah</th>

	                  						<th>Kadaluarsa</th>

	                  						<th>Pengguna</th>

	                  						<th>Aksi</th>

	                					</tr>
	                	
	                				</thead>
	                
	                				<tbody>

	                					@foreach($discounts as $discount)

							                <tr>

							                	<td>{{ $discount->dis_code }}</td>

							                  	<td>

							                  		<span class="badge badge-light">

							                  			{{ $discount->dis_type }}

							                  		</span>

							                  	</td>

							                  	<td>

							                  		@if($discount->min_trans != '')

						                  				{{ Utilities::rupiahFormat($discount->min_trans) }}

						                  			@else

						                  				-

						                  			@endif

						                  		</td>

							                  	<td>

								                  	@if($discount->dis_type == 'Fix')

								                  		{{ Utilities::rupiahFormat($discount->dis_value) }}

								                  	@else

								                  		{{ $discount->dis_value }}%

								                  	@endif

							                  	</td>

							                  	<td>

							                  		<span class="badge badge-info">

							                  			{{ $discount->dis_qty }}

							                  		</span>

							                  	</td>

							                  	<td>

							                  		<span class="badge badge-danger">

							                  			{{ date('d F Y', strtotime($discount->exp_date)) }}

							                  		</span>

							                  	</td>

							                  	<td>{{ $discount->user->u_name }}</td>

							                  	<td>
							                  		
							                  		<button class="button button-edit" data-toggle="modal" data-target="#editModal{{ $discount->dis_id }}">

							                  			<i class="fas fa-marker mr-1"></i> Edit

							                  		</button>

							                  		<div class="modal fade" id="editModal{{ $discount->dis_id }}">
								        
												        <div class="modal-dialog modal-lg">

												          	<div class="modal-content">

												            	<div class="modal-header">

												              		<h4 class="modal-title">Edit Diskon</h4>

											              			<button type="button" class="close" data-dismiss="modal" aria-label="Close">

											                			<span aria-hidden="true">&times;</span>
											              		
											              			</button>
												            		
												            	</div>

												            	<form action="{{ route('discount.update', $discount->dis_id) }}" method="POST">

												            		@method('PATCH')

												            		@csrf

											            			<div class="modal-body">

											            				<p class="text-secondary font-weight-bold">[*] Wajib Diisi</p>
								              		
							            								<div class="row">
												              	
													              			<div class="col-md-6">

											            						<div class="form-group">

												            						<label for="dis_code" class="modal-label">Kode *</label>
				    																	
				    																@error('dis_code')

																                  		<span class="text-danger"> {{ $message }}</span>

																                  	@enderror

				    																<input type="text" name="dis_code" value="{{ $discount->dis_code }}" class="modal-input {{ $errors->has('dis_code') ? ' is-invalid' : '' }}">

																				</div>

									            							</div>

											            					<div class="col-md-6">

											            						<div class="form-group">

											            							<label for="dis_type" class="modal-label">Tipe *</label>

											            							@error('dis_type')

																                  		<span class="text-danger"> {{ $message }}</span>

																                  	@enderror

												            						<div class="modal-dropdown">
																			        
																			        	<div class="select {{ $errors->has('dis_type') ? ' is-invalid' : '' }}">
																			          
																			          		<span>{{ $discount->dis_type }}</span>
																			        
																			        	  	<i class="fa fa-chevron-left"></i>
																			        
																			        	</div>
																			        
																			        	<input type="hidden" name="dis_type" value="{{ $discount->dis_type }}">
																			        
																			        	<ul class="dropdown-menu">
																			          
																			          		<li id="Fix">Fix</li>
																			          
																			          		<li id="Percent">Percent</li>
																			        
																			        	</ul>
																			      
																			      	</div>

																				</div>

											            					</div>

											            					<div class="col-md-6">

											            						<div class="form-group">

												            						<label for="min_trans" class="modal-label">Minimum</label>

												            						@error('min_trans')

																                  		<span class="text-danger"> {{ $message }}</span>

																                  	@enderror
				    									
				    																<input type="text" name="min_trans" value="{{ $discount->min_trans }}" class="modal-input {{ $errors->has('min_trans') ? ' is-invalid' : '' }}">

																				</div>

											            					</div>

											            					<div class="col-md-6">

											            						<div class="form-group">

												            						<label for="dis_value" class="modal-label">Nilai *</label>
				    										
												            						@error('dis_value')

																                  		<span class="text-danger"> {{ $message }}</span>

																                  	@enderror

				    																<input type="text" name="dis_value" value="{{ $discount->dis_value }}" class="modal-input {{ $errors->has('dis_value') ? ' is-invalid' : '' }}">

																				</div>

											            					</div>

											            					<div class="col-md-6">

											            						<div class="form-group">

												            						<label for="dis_qty" class="modal-label">Jumlah *</label>

												            						@error('dis_qty')

																                  		<span class="text-danger"> {{ $message }}</span>

																                  	@enderror
				    									
				    																<input type="number" name="dis_qty" value="{{ $discount->dis_qty }}" class="modal-input {{ $errors->has('dis_qty') ? ' is-invalid' : '' }}">

																				</div>

											            					</div>

											            					<div class="col-md-6">

											            						<div class="form-group">

												            						<label for="exp_date" class="modal-label">Kadaluarsa *</label>
				    										
												            						@error('exp_date')

																                  		<span class="text-danger"> {{ $message }}</span>

																                  	@enderror

				    																<input type="text" name="exp_date" value="{{ $discount->exp_date }}" class="exp-date modal-input {{ $errors->has('exp_date') ? ' is-invalid' : '' }}">

																				</div>

											            					</div>

											            				</div>
												            
												            		</div>
													            
													            	<div class="modal-footer justify-content-between">
													              
													              		<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
													              
												              			<button type="submit" class="btn btn-warning">Update</button>
													            	
													            	</div>

													            </form>
												          
												          	</div>
												          	<!-- /.modal-content -->
												        
												        </div>
												        <!-- /.modal-dialog -->
												      
												    </div>
												    <!-- /.modal -->

												    <button class="button button-red" data-toggle="modal" data-target="#delModal{{ $discount->dis_id }}">

							                  			<i class="fas fa-trash mr-1"></i> Hapus

							                  		</button>

							                  		<div class="modal fade" id="delModal{{ $discount->dis_id }}">
								        
												        <div class="modal-dialog">

												          <div class="modal-content">

												            <div class="modal-header">

												              	<h4 class="modal-title">Hapus Diskon</h4>

											              		<button type="button" class="close" data-dismiss="modal" aria-label="Close">

											                		<span aria-hidden="true">&times;</span>
											              		
											              		</button>
												            		
												            	</div>

												            	<form action="{{ route('discount.destroy', $discount->dis_id) }}" method="POST">

												            		@method('DELETE')

												            		@csrf

											            			<div class="modal-body">
												              	
												              			Yakin ingin menghapus diskon <b>{{ $discount->dis_code }}</b> ?
												            
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

	@include('scripts/msale')

@endsection
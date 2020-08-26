@extends('layouts.master')

@section('content')
	
	<body class="hold-transition sidebar-mini layout-fixed">
      
    	<div class="wrapper">

     		@include('layouts.top')

      		@include('layouts.sidebar')

	 		<!-- Content Wrapper. Contains page content -->
  			<div class="content-wrapper">
    
			<!-- Content Header (Page header) -->
    		@include('layouts.content_hd', ['title' => 'Role'])

		    <!-- Main content -->
		    <section class="content">
      
      			<div class="row">

      				<div class="col-md-12">
        
	          			<div class="card">
	            
	            			<div class="card-header bg-light">
	              
	              				<h3 class="card-title">Role <i class="fas fa-box-open ml-2"></i></h3>
	            				
	    					</div>
	        				<!-- /.card-header -->

	            			<div class="card-body">
	              
	              				<table id="masterTable" class="table table-bordered">
	                		
	              					<button class="button-s1 button-green mb-4" data-toggle="modal" data-target="#addModal">
    					
				    					Tambah Role

				    				</button>

				    				<div class="modal fade" id="addModal">
								        
								        <div class="modal-dialog">

								          <div class="modal-content">

								            <div class="modal-header">

								              	<h4 class="modal-title">Tambah Role</h4>

							              		<button type="button" class="close" data-dismiss="modal" aria-label="Close">

							                		<span aria-hidden="true">&times;</span>
							              		
							              		</button>
								            		
								            	</div>

								            	<form id="add-role-form">

								            		@csrf

							            			<div class="modal-body">
								              			
								              			<p class="text-secondary font-weight-bold">[*] Wajib Diisi</p>

								              			<div class="form-group">

										                  	<label class="modal-label">Nama *</label>

									                  		<br/>

									                  		<span class="text-danger add-role-name-error"></span>

									                  		<input 
									                  			type="text" 
									                  			name="role_name" 
									                  			class="modal-input add-role-name-modal-error" 
									                  			placeholder="Nama Role"
									                  		>

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
	                  				
											  <th>Role</th>
											  
											  <th>User</th>

											  <th>Aksi</th>

	                					</tr>
	                	
	                				</thead>
	                
	                				<tbody>

	                					@foreach($roles as $role)

							                <tr>

												<td>{{ $role->role_name }}</td>
												  
												<td><b>{{ $role->users->count() }}</b></td>

												<td>

													<button class="button-s1 button-yellow" data-toggle="modal" data-target="#editModal{{ $role->role_id }}">

														<i class="fas fa-marker mr-1"></i> Edit

													</button>

													<div class="modal fade" id="editModal{{ $role->role_id }}">
									  
													  	<div class="modal-dialog">

															<div class="modal-content">

														  		<div class="modal-header">

																	<h4 class="modal-title">Edit Role <i class="fas fa-box-open ml-2"></i></h3></h4>

																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">

																  		<span aria-hidden="true">&times;</span>
																
																	</button>
																  
															  	</div>

															  	<form class="edit-role-form" data-id={{ $role->role_id }}>

																	@csrf

																  	<div class="modal-body">

																	  	<p class="text-secondary font-weight-bold">[*] Wajib Diisi</p>	
																
																		<div class="form-group">

																			<label class="modal-label">Nama *</label>

																			<br/>

																			<span class="text-danger edit-role-name-error"></span>

																			<input 
																				type="text" 
																				name="role_name" 
																				class="modal-input edit-role-name-modal-error"
																				value="{{ $role->role_name }}"
																			>

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

												  	<button class="button-s1 button-red" data-toggle="modal" data-target="#delModal{{ $role->role_id }}">

														<i class="fas fa-trash mr-1"></i> Hapus

													</button>

													<div class="modal fade" id="delModal{{ $role->role_id }}">
									  
													  	<div class="modal-dialog">

															<div class="modal-content">

														  		<div class="modal-header">

																	<h4 class="modal-title">Hapus Role <i class="fas fa-box-open ml-2"></i></h3></h4>

																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">

																  		<span aria-hidden="true">&times;</span>
																
																	</button>
																  
															  	</div>

															  	<form action="{{ route('role.destroy', $role->role_id) }}" method="POST">

																  	@method('DELETE')

																  	@csrf

																  	<div class="modal-body">
																
																		Yakin ingin menghapus role <b>{{ $role->role_name }}</b> ?
														  
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

	@include('layouts/scripts/datatable')

	@include('layouts/scripts/muser')

@endsection
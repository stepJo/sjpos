@extends('layouts.master')

@section('content')
	
	<body class="hold-transition sidebar-mini layout-fixed">
      
    	<div class="wrapper">

     		@include('layouts.top')

      		@include('layouts.sidebar')

	 		<!-- Content Wrapper. Contains page content -->
  			<div class="content-wrapper">
    
			<!-- Content Header (Page header) -->
    		@include('layouts.title', ['title' => 'Role'])

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
								
								<button class="button-s1 button-green mb-4" data-toggle="modal" data-target="#addModal">
    					
									Tambah Role

								</button>

								<div class="modal fade" id="addModal">
									
									<div class="modal-dialog modal-lg">

									  <div class="modal-content">

										<div class="modal-header">

											  <h4 class="modal-title">Tambah Role</h4>

											  <button type="button" class="close" data-dismiss="modal" aria-label="Close">

												<span aria-hidden="true">&times;</span>
											  
											  </button>
												
											</div>

											<form id="add-role-form">

												<div class="modal-body">
													  
													<p class="text-secondary font-weight-bold">[*] Wajib Diisi</p>

													<div class="form-group">

														<label class="modal-label">Nama *</label>

														<br/>

														<span class="text-danger add-role-name-error"></span>

														<input 
															type="text" 
															id="role_name"
															name="role_name" 
															class="modal-input add-role-name-modal-error" 
															placeholder="Nama Role"
														>

													</div>

													<div class="row mt-4">

														<div class="col-md-8">

															<h4 class="font-weight-bold text-indigo">Akses Role</h4>
														
														</div>
														
														<div class="col-md-4">

															<input type="checkbox" id="all_access" class="all-access" name="all_access" value="1">
																
															<label for="all_access">Semua Akses</label>
																
														</div>

													</div>

													<div class="row mt-3">

														<div class="col-md-12">

															<table class="table table-hover table-bordered">

																<thead>
							
																	<tr>
																
																		<th>Menu</th>
							
																		<th class="text-center">Hak Akses</th>

																	</tr>
													
																</thead>
												
																<tbody>

																	@foreach($menus as $menu)

																		<tr>

																			<td><span class="text-indigo">{{ $menu->menu_name }}</span></td>

																			<input type="hidden" class="menu" name="menu[]" value="{{ $menu->menu_id }}">

																			<td>
																				
																				<div class="d-flex">

																					<div class="mx-4">

																						<input type="checkbox" id="{{ $menu->menu_name }}-view" name="view[]" class="av" value="1">
																			
																						<label for="{{ $menu->menu_name }}-view"><i class="fas fa-eye text-secondary"></i> Lihat</label>

																					</div>

																					{!! Roles::addField($menu) !!}

																					{!! Roles::editField($menu) !!}

																					{!! Roles::deleteField($menu) !!}

																				</div>
																			
																			</td>

																		</tr>

																	@endforeach
								
																</tbody>

															</table>

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

	              				<table id="masterTable" class="table table-bordered">
	                	
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
									  
													  	<div class="modal-dialog modal-lg">

															<div class="modal-content">

														  		<div class="modal-header">

																	<h4 class="modal-title">Edit Role <i class="fas fa-box-open ml-2"></i></h3></h4>

																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">

																  		<span aria-hidden="true">&times;</span>
																
																	</button>
																  
															  	</div>

															  	<form class="edit-role-form" data-id="{{ $role->role_id }}" id="edit-role-form-{{ $role->role_id }}">

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

																		<div class="row mt-4">

																			<div class="col-md-8">
					
																				<h4 class="font-weight-bold text-indigo">Akses Role</h4>
																			
																			</div>
																			
																			<div class="col-md-4">
					
																				<input type="checkbox" id="all_access--edit-{{ $role->role_id }}" class="all-access" name="all_access" value="1">
																					
																				<label for="all_access--edit-{{ $role->role_id }}">Semua Akses</label>
																					
																			</div>
					
																		</div>

																		<div class="row mt-3">

																			<div class="col-md-12">
																			  
																				<table class="table table-hover table-bordered">

																					<thead>
												
																						<tr>
																					
																							<th>Menu</th>
												
																							<th class="text-center">Hak Akses</th>
					
																						</tr>
																		
																					</thead>
																	
																					<tbody>
					
																						@foreach($menus as $menu)

																							<tr>
					
																								<td><span class="text-indigo">{{ $menu->menu_name }}</span></td>
					
																								<input type="hidden" class="menu" name="menu[]" value="{{ $menu->menu_id }}">
					
																								<td>
																									
																									<div class="d-flex">
					
																										{!! Roles::editViewField($role->role_id, $menu, $menu->roles) !!}
					
																										{!! Roles::editAddField($role->role_id, $menu, $menu->roles) !!}
					
																										{!! Roles::editEditField($role->role_id, $menu, $menu->roles) !!}
					
																										{!! Roles::editDeleteField($role->role_id, $menu, $menu->roles) !!}
					
																									</div>
																								
																								</td>
					
																							</tr>
					
																						@endforeach
													
																					</tbody>
					
																				</table>

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

	@include('scripts/muser')

@endsection
@extends('layouts.master')

@section('content')
	
	<body class="hold-transition sidebar-mini layout-fixed">
      
    	<div class="wrapper">

     		@include('layouts.top')

      		@include('layouts.sidebar')

	 		<!-- Content Wrapper. Contains page content -->
  			<div class="content-wrapper">
    
			<!-- Content Header (Page header) -->
    		@include('layouts.title', ['title' => 'Data User'])

		    <!-- Main content -->
		    <section class="content">
      
      			<div class="row">

      				<div class="col-md-12">
        
	          			<div class="card">
	            
	            			<div class="card-header bg-light">
	              
	              				<h3 class="card-title">User <i class="nav-icon fas fa-user ml-2"></i></h3>
	            				
	    					</div>
	        				<!-- /.card-header -->

	            			<div class="card-body">
	              
	              				<table id="masterTable" class="table table-hover">
	                		
	              					<button class="button-s1 button-green mb-4" data-toggle="modal" data-target="#addModal">
    					
				    					Tambah User

				    				</button>

				    				<div class="modal fade" id="addModal">
								        
								        <div class="modal-dialog modal-lg">

								          <div class="modal-content">

								            <div class="modal-header">

								              	<h4 class="modal-title">Tambah User <i class="nav-icon fas fa-user ml-2"></i></h4>

							              		<button type="button" class="close" data-dismiss="modal" aria-label="Close">

							                		<span aria-hidden="true">&times;</span>
							              		
							              		</button>
								            		
								            	</div>

								            	<form id="add-user-form">

								            		@csrf

							            			<div class="modal-body">
								              			
								              			<p class="text-secondary font-weight-bold">[*] Wajib Diisi</p>

								              			<div class="row">

								              				<div class="col-md-6">

										              			<div class="form-group">

												                  	<label class="modal-label">Nama *</label>

											                  		<br/>

											                  		<span class="text-danger add-u-name-error"></span>

											                  		<input 
											                  			type="text" 
											                  			name="u_name" 
											                  			class="modal-input add-u-name-modal-error" 
											                  			placeholder="Nama User"
											                  		>

												                </div>

												            </div>

								              				<div class="col-md-6">

                                                                <div class="form-group">

                                                                    <label class="modal-label">Email *</label>

                                                                    <br/>

                                                                    <span class="text-danger add-u-email-error"></span>

                                                                    <input 
                                                                        type="email" 
                                                                        name="u_email" 
                                                                        class="modal-input add-u-email-modal-error" 
                                                                        placeholder="Email User"
                                                                    >

                                                              </div>

												            </div>

												            <div class="col-md-6">

												            	<div class="form-group">

												                  	<label class="modal-label">Kontak *</label>

											                  		<br/>

											                  		<span class="text-danger add-u-contact-error"></span>

											                  		<input 
											                  			type="text" 
											                  			name="u_contact" 
											                  			class="modal-input add-u-contact-modal-error" 
											                  			placeholder="Kontak User"
											                  		>

												                </div> 	

															</div>
															
															<div class="col-md-6">

												            	<div class="form-group">

												                  	<label class="modal-label">Password *</label>

											                  		<br/>

											                  		<span class="text-danger add-u-password-error"></span>

											                  		<input 
											                  			type="password" 
											                  			name="u_password" 
											                  			class="modal-input add-u-password-modal-error" 
											                  			placeholder="Password User"
											                  		>

												                </div> 	

															</div>
															
															<div class="col-md-6">

												            	<div class="form-group">

												                  	<label class="modal-label">Konfirmasi Password *</label>

											                  		<br/>

											                  		<span class="text-danger add-confirm-password-error"></span>

											                  		<input 
											                  			type="password" 
											                  			name="confirm_password" 
											                  			class="modal-input add-confirm-password-modal-error" 
											                  			placeholder="Konfirmasi Password User"
											                  		>

												                </div> 	

															</div>
															
															<div class="col-md-6">

																<div class="form-group">
			
																	<label class="modal-label">Cabang *</label>
			
																	<br/>
			
																	<span class="text-danger add-b-id-error"></span>
			
																	<select class="form-control select2bs4 add-b-id-modal-error" style="width: 100%;" name="b_id">
																		
																		<option value="">- Pilih Cabang -</option>
	
																		@foreach($branches as $branch)
	
																			<option value="{{ $branch->b_id }}">{{ $branch->b_name }}</option>
	
																		@endforeach
	
																	</select>
			
																</div>
																
															</div>

															<div class="col-md-6">

																<div class="form-group">
			
																	<label class="modal-label">Role *</label>
			
																	<br/>
			
																	<span class="text-danger add-role-id-error"></span>
			
																	<select class="form-control select2bs4 add-role-id-modal-error" style="width: 100%;" name="role_id">
																		
																		<option value="">- Pilih Role -</option>
	
																		@foreach($roles as $role)
	
																			<option value="{{ $role->role_id }}">{{ $role->role_name }}</option>
	
																		@endforeach
	
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
	                  				
	                						<th>Nama</th>

	                  						<th>Email</th>

                                            <th>Kontak</th>
                                              
                                            <th>Cabang</th>

                                            <th>Role</th>

	                  						<th>Aksi</th>

	                					</tr>
	                	
	                				</thead>
	                
	                				<tbody>

	                					@foreach($users as $user)

							                <tr data-id="{{ $user->u_id }}">

							                  	<td>{{ $user->u_name }}</td>

							                  	<td>{{ $user->u_email }}</td>

                                                <td>{{ $user->u_contact }}</td>
                                                
                                                <td><span class="text-secondary">{{ $user->branch->b_name }}</span></td>

                                                <td><span class="font-weight-bold">{{ $user->role->role_name }}</span></td>
                                                  
							                  	<td class="actions">
							                  		
							                  		<div class="dropdown">
                            
							                            <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

							                                Aksi
							                            
							                            </button>

							                            <div class="dropdown-menu mr-5" aria-labelledby="dropdownMenuLink">
							                            
							                                <a class="dropdown-item text-warning" data-toggle="modal" data-target="#editModal{{ $user->u_id }}">

							                                    <i class="fas fa-edit mr-1"></i> Edit

															</a>
															
															<a class="dropdown-item text-dark" data-toggle="modal" data-target="#passwordModal{{ $user->u_id }}">

							                                    <i class="fas fa-lock mr-1"></i> Password

							                                </a>
							                            
							                                <a class="dropdown-item text-danger" data-toggle="modal" data-target="#delModal{{ $user->u_id }}">

							                                    <i class="fas fa-trash mr-1"></i> Hapus

							                                </a>
							                            
							                            </div>

							                        </div>

							                  		<div class="modal fade" id="editModal{{ $user->u_id }}">
								        
												        <div class="modal-dialog modal-lg">

												          <div class="modal-content">

												            <div class="modal-header">

												              	<h4 class="modal-title">Edit User <i class="nav-icon fas fa-user ml-2"></i></h4>

											              		<button type="button" class="close" data-dismiss="modal" aria-label="Close">

											                		<span aria-hidden="true">&times;</span>
											              		
											              		</button>
												            		
												            	</div>

												            	<form class="edit-user-form" data-id="{{ $user->u_id }}">

												            		@method('PATCH')

												            		@csrf

											            			<div class="modal-body">

											            				<p class="text-secondary font-weight-bold">[*] Wajib Diisi</p>

											            				<div class="row">

												              				<div class="col-md-6">

                                                                                <div class="form-group">

                                                                                    <label class="modal-label">Nama *</label>
              
                                                                                    <br/>
              
                                                                                    <span class="text-danger edit-u-name-error"></span>
              
                                                                                    <input 
                                                                                        type="text" 
                                                                                        name="u_name" 
                                                                                        class="modal-input edit-u-name-modal-error" 
                                                                                        value="{{ $user->u_name }}"
                                                                                    >
              
                                                                                </div>

																            </div>

                                                                            <div class="col-md-6">

                                                                                <div class="form-group">

                                                                                    <label class="modal-label">Email *</label>
              
                                                                                    <br/>
              
                                                                                    <span class="text-danger edit-u-email-error"></span>
              
                                                                                    <input 
                                                                                        type="email" 
                                                                                        name="u_email" 
                                                                                        class="modal-input edit-u-email-modal-error" 
                                                                                        value="{{ $user->u_email }}"
                                                                                    >
              
																				</div>
																				
																            </div>

																			<div class="col-md-6">

																				<div class="form-group">

																					<label class="modal-label">Kontak *</label>
			  
																					<br/>
			  
																					<span class="text-danger edit-u-contact-error"></span>
			  
																					<input 
																						type="text" 
																						name="u_contact" 
																						class="modal-input edit-u-contact-modal-error" 
																						value="{{ $user->u_contact }}"
																					>
			  
																				</div>

																			</div>

																			<div class="col-md-6">

																				<div class="form-group">
							
																					<label class="modal-label">Cabang *</label>
							
																					<br/>
							
																					<span class="text-danger edit-b-id-error"></span>
							
																					<select class="form-control select2bs4 edit-b-id-modal-error" style="width: 100%;" name="b_id">
																						
																						@foreach($branches as $branch)
																						
																							@if($branch->b_id == $user->branch->b_id)

																								<option value="{{ $branch->b_id }}" selected>{{ $branch->b_name }}</option>

																							@else

																								<option value="{{ $branch->b_id }}">{{ $branch->b_name }}</option>

																							@endif

																						@endforeach
					
																					</select>
							
																				</div>
																				
																			</div>
				
																			<div class="col-md-6">
				
																				<div class="form-group">
							
																					<label class="modal-label">Role *</label>
							
																					<br/>
							
																					<span class="text-danger edit-role-id-error"></span>
							
																					<select class="form-control select2bs4 edit-role-id-modal-error" style="width: 100%;" name="role_id">
																					
																						@foreach($roles as $role)

																							@if($role->role_id == $user->role->role_id)
					
																								<option value="{{ $role->role_id }}" selected>{{ $role->role_name }}</option>

																							@else

																							<option value="{{ $role->role_id }}">{{ $role->role_name }}</option>

																							@endif

																						@endforeach
					
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
													
													<div class="modal fade" id="passwordModal{{ $user->u_id }}">
								        
												        <div class="modal-dialog modal-lg">

												          <div class="modal-content">

												            <div class="modal-header">

												              	<h4 class="modal-title">Edit Password User <i class="nav-icon fas fa-user ml-2"></i></h4>

											              		<button type="button" class="close" data-dismiss="modal" aria-label="Close">

											                		<span aria-hidden="true">&times;</span>
											              		
											              		</button>
												            		
												            	</div>

												            	<form class="edit-user-password-form" data-id="{{ $user->u_id }}">

												            		@method('PATCH')

												            		@csrf

											            			<div class="modal-body">

											            				<p class="text-secondary font-weight-bold">[*] Wajib Diisi</p>

											            				<div class="row">

																			<div class="col-md-6">

																				<div class="form-group">
				
																					  <label class="modal-label">Password *</label>
				
																					  <br/>
				
																					  <span class="text-danger edit-u-password-error"></span>
				
																					  <input 
																						  type="password" 
																						  name="u_password" 
																						  class="modal-input edit-u-password-modal-error" 
																						  placeholder="Password User"
																					  >
				
																				</div> 	
				
																			</div>
																			
																			<div class="col-md-6">
				
																				<div class="form-group">
				
																					  <label class="modal-label">Konfirmasi Password *</label>
				
																					  <br/>
				
																					  <span class="text-danger edit-confirm-password-error"></span>
				
																					  <input 
																						  type="password" 
																						  name="confirm_password" 
																						  class="modal-input edit-confirm-password-modal-error" 
																						  placeholder="Konfirmasi Password User"
																					  >
				
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

							                  		<div class="modal fade" id="delModal{{ $user->u_id }}">
								        
												        <div class="modal-dialog">

												          <div class="modal-content">

												            <div class="modal-header">

												              	<h4 class="modal-title">Hapus User <i class="nav-icon fas fa-user ml-2"></i></h4>

											              		<button type="button" class="close" data-dismiss="modal" aria-label="Close">

											                		<span aria-hidden="true">&times;</span>
											              		
											              		</button>
												            		
												            	</div>

												            	<form action="{{ route('user.destroy', $user->u_id) }}" method="POST">

												            		@method('DELETE')

												            		@csrf

											            			<div class="modal-body">
												              	
												              			Yakin ingin menghapus User <b>{{ $user->u_name }}</b> ?
												            
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
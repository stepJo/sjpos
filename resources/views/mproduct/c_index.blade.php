@extends('layouts.master')

@section('content')
	
	<body class="hold-transition sidebar-mini layout-fixed">
      
    	<div class="wrapper">

     		@include('layouts.top')

      		@include('layouts.sidebar')

	 		<!-- Content Wrapper. Contains page content -->
  			<div class="content-wrapper">
    
			<!-- Content Header (Page header) -->
    		@include('layouts.title', ['title' => 'Data Kategori'])

		    <!-- Main content -->
		    <section class="content">
      
      			<div class="row">

      				<div class="col-md-12">
        
	          			<div class="card">
	            
	            			<div class="card-header bg-light">
	              
	              				<h3 class="card-title">Kategori <i class="fas fa-box-open ml-2"></i></h3>
	            				
	    					</div>
	        				<!-- /.card-header -->

	            			<div class="card-body">
	              
	              				<table id="masterTable" class="table table-hover">
									
									@if($access->add == 1)

										<button class="button-s1 button-green mb-4" data-toggle="modal" data-target="#addModal">
							
											Tambah Kategori

										</button>

										<div class="modal fade" id="addModal">
											
											<div class="modal-dialog">

											<div class="modal-content">

												<div class="modal-header">

													<h4 class="modal-title">Tambah Kategori <i class="fas fa-box-open ml-2"></i></h4>

													<button type="button" class="close" data-dismiss="modal" aria-label="Close">

														<span aria-hidden="true">&times;</span>
													
													</button>
														
													</div>

													<form id="add-category-form">
														
														<div class="modal-body">
															
															<p class="text-secondary font-weight-bold">[*] Wajib Diisi</p>

															<div class="form-group">

																<label class="modal-label">Nama *</label>

																<br/>

																<span class="text-danger add-cat-name-error"></span>

																<input 
																	type="text" 
																	name="cat_name" 
																	class="modal-input add-cat-name-modal-error" 
																	placeholder="Nama Kategori"
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

									@endif

	                				<thead>
	                
	                					<tr>
	                  				
	                						<th>ID</th>

	                  						<th>Nama</th>

	                  						<th>Jumlah Produk</th>

	                  						<th>Aksi</th>

	                					</tr>
	                	
	                				</thead>
	                
	                				<tbody>

	                					@foreach($categories as $category)

							                <tr>

							                	<td>{{ $category->cat_id }}</td>

							                  	<td>{{ $category->cat_name }}</td>

							                  	<td>{{ $category->products->count() }}</td>

							                  	<td>

													@if($access->edit != 1 && $access->delete != 1)

														{!! Roles::noAccess() !!}

													@endif
													  
													@if($access->edit == 1)

														<button class="button-s1 button-yellow" data-toggle="modal" data-target="#editModal{{ $category->cat_id }}">

															<i class="fas fa-marker mr-1"></i> Edit

														</button>

														<div class="modal fade" id="editModal{{ $category->cat_id }}">
											
															<div class="modal-dialog">

															<div class="modal-content">

																<div class="modal-header">

																	<h4 class="modal-title">Edit Kategori <i class="fas fa-box-open ml-2"></i></h4>

																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">

																		<span aria-hidden="true">&times;</span>
																	
																	</button>
																		
																	</div>

																	<form class="edit-category-form" data-id={{ $category->cat_id }}>

																		<div class="modal-body">

																			<p class="text-secondary font-weight-bold">[*] Wajib Diisi</p>	
																	
																			<div class="form-group">

																				<label class="modal-label">Nama *</label>

																				<br/>

																				<span class="text-danger edit-cat-name-error"></span>

																				<input 
																					type="text" 
																					name="cat_name" 
																					class="modal-input edit-cat-name-modal-error"
																					value="{{ $category->cat_name }}"
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

													@endif

													@if($access->delete == 1)

														<button class="button-s1 button-red" data-toggle="modal" data-target="#delModal{{ $category->cat_id }}">

															<i class="fas fa-trash mr-1"></i> Hapus

														</button>

														<div class="modal fade" id="delModal{{ $category->cat_id }}">
											
															<div class="modal-dialog">

															<div class="modal-content">

																<div class="modal-header">

																	<h4 class="modal-title">Hapus Kategori <i class="fas fa-box-open ml-2"></i></h4>

																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">

																		<span aria-hidden="true">&times;</span>
																	
																	</button>
																		
																	</div>

																	<form action="{{ route('category.destroy', $category->cat_id) }}" method="POST">

																		@method('DELETE')

																		@csrf

																		<div class="modal-body">
																	
																			Yakin ingin menghapus kategori <b>{{ $category->cat_name }}</b> ?
																
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

													@endif

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

	@include('scripts/mproduct')

@endsection
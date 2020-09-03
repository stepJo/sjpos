@extends('layouts.master')

@section('content')
	
	<body class="hold-transition sidebar-mini layout-fixed">
      
    	<div class="wrapper">

     		@include('layouts.top')

      		@include('layouts.sidebar')

	 		<!-- Content Wrapper. Contains page content -->
  			<div class="content-wrapper">
    
			<!-- Content Header (Page header) -->
    		@include('layouts.title', ['title' => 'Data Satuan'])

		    <!-- Main content -->
		    <section class="content">
      
      			<div class="row">

      				<div class="col-md-12">
        
	          			<div class="card">
	            
	            			<div class="card-header bg-light">
	              
	              				<h3 class="card-title">Satuan <i class="fas fa-box-open ml-2"></i></h3>
	            				
	    					</div>
	        				<!-- /.card-header -->

	            			<div class="card-body">
	              
	              				<table id="masterTable" class="table table-hover">
	                		
	              					<button class="button-s1 button-green mb-4" data-toggle="modal" data-target="#addModal">
    					
				    					Tambah Satuan

				    				</button>

				    				<div class="modal fade" id="addModal">
								        
								        <div class="modal-dialog">

								          <div class="modal-content">

								            <div class="modal-header">

								              	<h4 class="modal-title">Tambah Satuan <i class="fas fa-box-open ml-2"></i></h4>

							              		<button type="button" class="close" data-dismiss="modal" aria-label="Close">

							                		<span aria-hidden="true">&times;</span>
							              		
							              		</button>
								            		
								            	</div>

								            	<form id="add-unit-form">

								            		@csrf

							            			<div class="modal-body">
								              		
							            				<p class="text-secondary font-weight-bold">[*] Wajib Diisi</p>

								              			<div class="form-group">

										                  	<label class="modal-label">Nama *</label>

									                  		<br/>

									                  		<span class="text-danger add-unit-name-error"></span>

									                  		<input 
									                  			type="text" 
									                  			name="unit_name" 
									                  			class="modal-input add-unit-name-modal-error" 
									                  			placeholder="Nama Satuan"
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
	                 
	                						<th>ID</th>

	                  						<th>Nama</th>

	                  						<th>Jumlah Produk</th>

	                  						<th>Aksi</th>

	                					</tr>
	                	
	                				</thead>
	                
	                				<tbody>

	                					@foreach($units as $unit)

							                <tr>

							                	<td>{{ $unit->unit_id }}</td>

							                  	<td>{{ $unit->unit_name }}</td>

							                  	<td>{{ $unit->products->count() }}</td>

							                  	<td>

								                  	<button class="button-s1 button-yellow" data-toggle="modal" data-target="#editModal{{ $unit->unit_id }}">

							                  			<i class="fas fa-marker mr-1"></i> Edit

							                  		</button>

							                  		<div class="modal fade" id="editModal{{ $unit->unit_id }}">
								        
												        <div class="modal-dialog">

												          	<div class="modal-content">

												            	<div class="modal-header">

												              		<h4 class="modal-title">Edit Satuan <i class="fas fa-box-open ml-2"></i></h4>

											              			<button type="button" class="close" data-dismiss="modal" aria-label="Close">

											                			<span aria-hidden="true">&times;</span>
											              		
											              			</button>
												            		
												            	</div>

												            	<form class="edit-unit-form" data-id="{{ $unit->unit_id }}">

												            		@csrf

											            			<div class="modal-body">

											            				<p class="text-secondary font-weight-bold">[*] Wajib Diisi</p>
												              	
												              			<div class="form-group">

														                  	<label class="modal-label">Nama *</label>

													                  		<br/>

													                  		<span class="text-danger edit-unit-name-error"></span>

													                  		<input 
													                  			type="text" 
													                  			name="unit_name" 
													                  			class="modal-input edit-unit-name-modal-error"
													                  			value="{{ $unit->unit_name }}"
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

												    <button class="button-s1 button-red" data-toggle="modal" data-target="#delModal{{ $unit->unit_id }}">

							                  			<i class="fas fa-trash mr-1"></i> Hapus

							                  		</button>

							                  		<div class="modal fade" id="delModal{{ $unit->unit_id }}">
								        
												        <div class="modal-dialog">

												          	<div class="modal-content">

											            		<div class="modal-header">

												              		<h4 class="modal-title">Hapus Satuan <i class="fas fa-box-open ml-2"></i></h4>

											              			<button type="button" class="close" data-dismiss="modal" aria-label="Close">

											                			<span aria-hidden="true">&times;</span>
											              		
											              			</button>
												            		
												            	</div>

												            	<form action="{{ route('unit.destroy', $unit->unit_id) }}" method="POST">

												            		@method('DELETE')

												            		@csrf

											            			<div class="modal-body">
												              	
												              			Yakin ingin menghapus satuan <b>{{ $unit->unit_name }}</b> ?
												            
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

	@include('scripts/mproduct')

@endsection
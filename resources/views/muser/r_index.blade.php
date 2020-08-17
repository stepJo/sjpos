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
	              
	              				<h3 class="card-title">Role</h3>
	            				
	    					</div>
	        				<!-- /.card-header -->

	            			<div class="card-body">
	              
	              				<table id="masterTable" class="table table-bordered">
	                		
	              					<button class="btn btn-success mb-4" data-toggle="modal" data-target="#addModal">
    					
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

								            	<form action="{{ route('category.store') }}" method="POST">

								            		@csrf

							            			<div class="modal-body">
								              	
								              			<div class="form-group">

										                  	<label>Nama</label>

										                  	@error('cat_name')

										                  		<br/>

										                  		<span class="text-danger"> {{ $message }}</span>

										                  	@enderror

									                  		<input 
									                  			type="text" 
									                  			name="cat_name" 
									                  			class="form-control {{ $errors->has('cat_name') ? ' is-invalid' : '' }}" 
									                  			placeholder="Nama Kategori"
									                  			value="{{ old('cat_name') }}"
									                  		>

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
	                  				
	                						<th>#</th>

	                  						<th>Nama</th>

	                  						<th>Aksi</th>

	                					</tr>
	                	
	                				</thead>
	                
	                				<tbody>

	                					@foreach($categories as $category)

							                <tr>

							                	<td>{{ $loop->iteration }}</td>

							                  	<td>{{ $category->cat_name }}</td>

							                  	<td></td>

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
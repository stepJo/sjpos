@extends('layouts.master')

@section('content')

	<body class="hold-transition sidebar-mini layout-fixed">

    	<div class="wrapper">

     		@include('layouts.top')

      		@include('layouts.sidebar')

	 		<!-- Content Wrapper. Contains page content -->
  			<div class="content-wrapper">

			<!-- Content Header (Page header) -->
    		@include('layouts.title', ['title' => 'Tamba Produk'])

		    <!-- Main content -->
		    <section class="content">

      			<div class="row">

      				<div class="col-md-10">

	          			<div class="card">

	            			<div class="card-header bg-success">

	              				<h3 class="card-title">Produk <i class="fas fa-box-open ml-2"></i></h3>

	    					</div>
	        				<!-- /.card-header -->

	            			<div class="card-body">

	            				<p class="text-secondary font-weight-bold">[*] Wajib Diisi</p>

	            				<form action="{{ route('product.store') }}" enctype="multipart/form-data" method="POST" class="form">

	            					@csrf

	            					<div class="row">

	            						<div class="col-md-4">

	            							<div class="form-group">

			            						<fieldset>

			            							@error('p_name')

								                  		<span class="text-danger"> {{ $message }}</span>

								                  	@enderror
		
													<div class="input-wrapper {{ $errors->has('p_name') ? ' is-invalid' : '' }}">
														
														<label for="p_name">
															
															Nama *
														
														</label>
														
														<input 
															id="p_name" 
															name="p_name"
															class="input-text" 
															type="text" 
															value="{{ old('p_name') }}" 
															placeholder="" 	
														/>

													</div>
			
												</fieldset>

											</div>

			            				</div>

			            				<div class="col-md-4">

	            							<div class="form-group">

			            						<fieldset>

			            							@error('p_code')

								                  		<span class="text-danger"> {{ $message }}</span>

								                  	@enderror
		
													<div class="input-wrapper {{ $errors->has('p_code') ? ' is-invalid' : '' }}">
														
														<label for="p_code">
															
															Kode *
														
														</label>
														
														<input 
															id="p_code" 
															name="p_code"
															class="input-text" 
															type="text" 
															value="{{ old('p_code') }}" 
															placeholder="" 	
														/>

													</div>
			
												</fieldset>

											</div>

			            				</div>

			            				<div class="col-md-4">

	            							<div class="form-group">

			            						<fieldset>

			            							@error('p_price')

								                  		<span class="text-danger"> {{ $message }}</span>

								                  	@enderror
		
													<div class="input-wrapper {{ $errors->has('p_price') ? ' is-invalid' : '' }}">
														
														<label for="p_price">
															
															Harga *
														
														</label>
														
														<input 
															id="p_price" 
															name="p_price"
															class="input-text" 
															type="text" 
															value="{{ old('p_price') }}" 
															placeholder="" 	
														/>

													</div>
			
												</fieldset>

											</div>

			            				</div>	        

			            				<div class="col-md-4">

			            					<div class="form-group">

			            						<label for="cat_id">Kategori *</label>

			            						@error('cat_id')

							                  		<span class="text-danger"> {{ $message }}</span>

							                  	@enderror

			            						<div class="dropdown-input">

											        <div class="select {{ $errors->has('cat_id') ? ' is-invalid' : '' }}">
											          
											          	<span>- Kategori Produk -</span>
											          
											          	<i class="fa fa-chevron-left"></i>
											        
											        </div>
											        
											        <input type="hidden" id="cat_id" name="cat_id">
											        
											        <ul class="dropdown-menu">
											        	
											        	@foreach($categories as $category)

											          		<li id="{{ $category->cat_id }}">{{ $category->cat_name }}</li>
											          
											          	@endforeach
											        
										        	</ul>
											      
											    </div>

			            					</div>

			            				</div>  

			            				<div class="col-md-4">

			            					<div class="form-group">

			            						<label for="unit_id">Satuan *</label>

			            						@error('unit_id')

							                  		<span class="text-danger"> {{ $message }}</span>

							                  	@enderror

			            						<div class="dropdown-input">

											        <div class="select {{ $errors->has('unit_id') ? ' is-invalid' : '' }}">
											          
											          	<span>- Satuan Produk -</span>
											          
											          	<i class="fa fa-chevron-left"></i>
											        
											        </div>
											        
											        <input type="hidden" id="unit_id" name="unit_id">
											        
											        <ul class="dropdown-menu">
											        	
											        	@foreach($units as $unit)

											          		<li id="{{ $unit->unit_id }}">{{ $unit->unit_name }}</li>
											          
											          	@endforeach
											        
										        	</ul>
											      
											    </div>

			            					</div>

			            				</div>  			

			            				<div class="col-md-4">

			            					<div class="form-group">

			            						<label for="p_status">Status *</label>

			            						@error('p_status')

							                  		<span class="text-danger"> {{ $message }}</span>

							                  	@enderror

			            						<select class="form-control modal-input {{ $errors->has('p_status') ? ' is-invalid' : '' }}" name="p_status" id="p_status">

						                        	<option value="" class="font-weight-bold" selected>- Status Produk -</option>

					                          		<option value="1" class="font-italic font-weight-bold 	text-success">Aktif</option>

					                          		<option value="0" class="font-italic font-weight-bold text-danger">Tidak Aktif</option>

						                        </select>

			            					</div>

			            				</div>

			            				<div class="col-md-7">

			            					<div class="form-group">

			            						<label for="p_desc">Deskripsi</label>

				            					<div class="textarea_c">

												  	<textarea class="textarea-input" id="p_desc" name="p_desc">{{ old('p_desc') }}</textarea>
												
												</div>

	          								</div>

			            				</div>

			            				<div class="offset-md-1 col-md-4 mt-4">

			            					<label for="p_image">Gambar *</label>

			            					@error('p_image')

						                  		<span class="text-danger"> {{ $message }}</span>

						                  	@enderror

			            					<div class="panel">

												<div class="button_outer">

													<div class="btn_upload">

														<input type="file" id="upload_file" name="p_image">
														
														Upload Gambar

													</div>

													<div class="processing_bar"></div>

													<div class="success_box"></div>

												</div>

											</div>

											<div class="error_msg"></div>

											<div class="uploaded_file_view" id="uploaded_view">

												<span class="file_remove">X</span>

											</div>

			            				</div>

			            			</div>

			            			<button type="submit" class="button-s1 button-green">Simpan</button>

			            			<a href="{{ url('product') }}" class="button-s1 button-grey">Kembali</a>	

	            				</form>

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
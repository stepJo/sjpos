@extends('layouts.master')

@section('content')
	
	<body class="hold-transition sidebar-mini layout-fixed">
      
    	<div class="wrapper">

     		@include('layouts.top')

      		@include('layouts.sidebar')

	 		<!-- Content Wrapper. Contains page content -->
  			<div class="content-wrapper">
    
			<!-- Content Header (Page header) -->
    		@include('layouts.title', ['title' => 'Master Aplikasi'])

		    <!-- Main content -->
		    <section class="content">
      
      			<div class="row">

      				<div class="col-md-8 offset-md-2">
        
	          			<div class="card">
	            
	            			<div class="card-header bg-light">
	              
	              				<h3 class="card-title">Profil <i class="fas fa-home ml-2"></i></h3>

	    					</div>
	        				<!-- /.card-header -->

	            			<div class="card-body">
								
								<div class="row">

									<div class="col-md-6">

										<p>

											Nama :

											<span class="font-weight-bold ml-1">{{ $profile->app_name }}</span>
										
										</p>

										<p>

											Email :

											<span class="font-weight-bold ml-1">{{ $profile->app_email }}</span>
										
										</p>

										<p>

											Kontak :

											<span class="font-weight-bold ml-1">{{ Utilities::emptyFormat($profile->app_contact) }}</span>
										
										</p>

										<p>

											Alamat :

											<span class="font-weight-bold ml-1">{{ Utilities::emptyFormat($profile->app_address) }}</span>
										
										</p>

									</div>

									<div class="col-md-6">

										<p class="font-we">Logo</p>

										{!! Utilities::renderImage('profiles', $profile->app_logo) !!}

										<button class="button-s1 button-purple" data-toggle="modal" data-target="#editLogoModal">Edit Logo</button>

                                        <div class="modal fade" id="editLogoModal">
                                        
                                            <div class="modal-dialog">
    
                                                <div class="modal-content">
    
                                                    <div class="modal-header">
    
                                                        <h4 class="modal-title">Edit Logo Aplikasi <i class="nav-icon fas fa-home ml-2"></i></h4>
    
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    
                                                            <span aria-hidden="true">&times;</span>
                                                    
                                                        </button>
                                                        
                                                    </div>
    
                                                    <form class="edit-logo-form" data-id="{{ $profile->id }}">

                                                        <div class="modal-body">
                                                            
                                                            <p class="text-secondary font-weight-bold">[*] Wajib Diisi</p>
    
                                                            <div class="row">
    
                                                                <div class="col-md-6 offset-md-3">

                                                                    <label for="image">Logo *</label>

                                                                    <br/>

                                                                    <span class="text-danger edit-image-error"></span>

                                                                    <div class="panel">

                                                                        <div class="button_outer">

                                                                            <div class="btn_upload">

                                                                                <input type="file" id="upload_file" name="image" class="edit-image-modal-error">
                                                                                
                                                                                Upload Logo

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

									</div>
								
									<button class="button-s1 button-yellow" data-toggle="modal" data-target="#editModal">Edit</button>

									<div class="modal fade" id="editModal">
                                        
                                        <div class="modal-dialog">

                                            <div class="modal-content">

                                                <div class="modal-header">

                                                    <h4 class="modal-title">Edit Profil Aplikasi <i class="nav-icon fas fa-home ml-2"></i></h4>

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                                        <span aria-hidden="true">&times;</span>
                                                
                                                    </button>
                                                    
                                                </div>

                                                <form class="edit-profile-form" enctype="multipart/form-data" data-id="{{ $profile->id }}">

                                                    <div class="modal-body">
                                                        
                                                        <p class="text-secondary font-weight-bold">[*] Wajib Diisi</p>

                                                        <div class="row">

                                                            <div class="col-md-12">

                                                                <div class="form-group">

                                                                    <label class="modal-label">Nama *</label>

                                                                    <br/>

                                                                    <span class="text-danger edit-app-name-error"></span>

                                                                    <input 
                                                                        type="text" 
                                                                        name="app_name" 
                                                                        class="modal-input edit-app-name-modal-error" 
                                                                        value="{{ $profile->app_name }}"
                                                                    > 

                                                                </div>

																<div class="form-group">

                                                                    <label class="modal-label">Email *</label>

                                                                    <br/>

                                                                    <span class="text-danger edit-app-email-error"></span>

                                                                    <input 
                                                                        type="email" 
                                                                        name="app_email" 
                                                                        class="modal-input edit-app-email-modal-error" 
                                                                        value="{{ $profile->app_email }}"
                                                                    > 

																</div>
																
																<div class="form-group">

                                                                    <label class="modal-label">Kontak</label>

                                                                    <br/>

                                                                    <span class="text-danger edit-app-contact-error"></span>

                                                                    <input 
                                                                        type="text" 
                                                                        name="app_contact" 
                                                                        class="modal-input edit-app-contact-modal-error" 
                                                                        value="{{ $profile->app_contact }}"
                                                                    > 

                                                                </div>
                                                                
                                                                <div class="form-group">

                                                                    <label class="modal-label">Alamat</label>

                                                                    <br/>

                                                                    <span class="text-danger edit-app-address-error"></span>

                                                                    <textarea class="textarea-input edit-app-address-modal-error" name="app_address">{{ $profile->app_address }}</textarea>
                                                            
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

								</div>

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

    @include('scripts/mapp')

@endsection
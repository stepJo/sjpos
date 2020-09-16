@extends('layouts.master')

@section('content')
	
	<body class="hold-transition sidebar-mini layout-fixed">
      
    	<div class="wrapper">

     		@include('layouts.top')

      		@include('layouts.sidebar')

	 		<!-- Content Wrapper. Contains page content -->
  			<div class="content-wrapper">
    
			<!-- Content Header (Page header) -->
    		@include('layouts.title', ['title' => 'Data Cabang'])
		    <!-- Main content -->
		    <section class="content">
      
      			<div class="row">

      				<div class="col-md-12">
        
	          			<div class="card">
	            
	            			<div class="card-header bg-light">
	              
	              				<h3 class="card-title">Cabang <i class="fas fa-store ml-2"></i></h3>
	            				
	    					</div>
	        				<!-- /.card-header -->

	            			<div class="card-body">	

                                @if($access->add == 1)

                                    <button class="button-s1 button-green mb-4" data-toggle="modal" data-target="#addModal">
                            
                                        Tambah Cabang

                                    </button>
                                    
                                    <div class="modal fade" id="addModal">
                                        
                                        <div class="modal-dialog modal-lg">

                                            <div class="modal-content">

                                                <div class="modal-header">

                                                    <h4 class="modal-title">Tambah Cabang <i class="nav-icon fas fa-store ml-2"></i></h4>

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                                        <span aria-hidden="true">&times;</span>
                                                
                                                    </button>
                                                    
                                                </div>

                                                <form id="add-branch-form">

                                                    <div class="modal-body">
                                                        
                                                        <p class="text-secondary font-weight-bold">[*] Wajib Diisi</p>

                                                        <div class="row">

                                                            <div class="col-md-6">

                                                                <div class="form-group">

                                                                    <label class="modal-label">Kode *</label>

                                                                    <br/>

                                                                    <span class="text-danger add-b-code-error"></span>

                                                                    <input 
                                                                        type="text" 
                                                                        name="b_code" 
                                                                        class="modal-input add-b-code-modal-error" 
                                                                        placeholder="Kode Cabang"
                                                                    > 

                                                                </div>

                                                                <div class="form-group">

                                                                    <label class="modal-label">Email *</label>

                                                                    <br/>

                                                                    <span class="text-danger add-b-email-error"></span>

                                                                    <input 
                                                                        type="email" 
                                                                        name="b_email" 
                                                                        class="modal-input add-b-email-modal-error" 
                                                                        placeholder="Email Cabang"
                                                                    > 

                                                                </div>
                                                                
                                                                <div class="form-group">

                                                                    <label class="modal-label">Deskripsi</label>

                                                                    <br/>

                                                                    <span class="text-danger add-b-desc-error"></span>

                                                                    <textarea class="textarea-input add-b-desc-modal-error" placeholder="Deskripsi Cabang" name=b_desc"></textarea>
                                                            
                                                                </div>

                                                                <div class="form-group">
                    
                                                                    <label for="b_status">Status *</label>

                                                                    <br/>

                                                                    <span class="text-danger add-b-status-error"></span>
                    
                                                                    <select class="select modal-input add-b-status-modal-error" name="b_status" id="b_status">
                    
                                                                        <option value="" class="font-weight-bold" selected>- Status Cabang -</option>
                    
                                                                        <option value="1" class="font-weight-bold text-success">Aktif</option>
                    
                                                                        <option value="0" class="font-weight-bold text-danger">Tidak Aktif</option>
                    
                                                                    </select>
                    
                                                                </div>
                    
                                                            </div>
                                                            
                                                            <div class="col-md-6">

                                                                <div class="form-group">

                                                                    <label class="modal-label">Nama *</label>

                                                                    <br/>

                                                                    <span class="text-danger add-b-name-error"></span>

                                                                    <input 
                                                                        type="text" 
                                                                        name="b_name" 
                                                                        class="modal-input add-b-name-modal-error" 
                                                                        placeholder="Nama Cabang"
                                                                    > 

                                                                </div>
                                                                
                                                                <div class="form-group">

                                                                    <label class="modal-label">Kontak *</label>

                                                                    <br/>

                                                                    <span class="text-danger add-b-contact-error"></span>

                                                                    <input 
                                                                        type="text" 
                                                                        name="b_contact" 
                                                                        class="modal-input add-b-contact-modal-error" 
                                                                        placeholder="Kontak Cabang"
                                                                    > 

                                                                </div>

                                                                <div class="form-group">

                                                                    <label class="modal-label">Alamat</label>

                                                                    <br/>

                                                                        <span class="text-danger add-b-address-error"></span>

                                                                        <textarea class="textarea-input add-b-address-modal-error" placeholder="Alamat Cabang" name="b_address"></textarea>
                                                            
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

                                @endif
	              
	              				<table id="branchTable" class="table table-hover">
	                		
	              					<div class="offset-md-12 d-flex justify-content-end mb-3">

	              						<a href="{{ route('branch-csv') }}" target="_blank" class="button-s1 button-grey mr-2"><i class="fas fa-file-csv mr-1"></i> Expor CSV</a>

	              						<a href="{{ route('branch-excel') }}" target="_blank" class="button-s1 button-darkgreen mr-2"><i class="fas fa-file-excel mr-1"></i> Expor Excel</a>

	              						<a href="{{ route('branch-pdf') }}" target="_blank" class="button-s1 button-darkorange mr-2"><i class="fas fa-file-pdf mr-1"></i> Expor PDF</a>
	              						
	              					</div>

	                				<thead>
	                
	                					<tr>
	                  				
	                						<th>Nama</th>

                                            <th>Email</th>
                                              
                                            <th>Kontak</th>

	                  						<th>Alamat</th>

	                  						<th>Status</th>

	                  						<th>Aksi</th>

	                					</tr>
	                	
	                				</thead>
	                
	                				<tbody>

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

	@include('scripts/mbranch')

@endsection
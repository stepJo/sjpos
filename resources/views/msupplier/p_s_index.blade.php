@extends('layouts.master')

@section('content')
	
	<body class="hold-transition sidebar-mini layout-fixed">
      
    	<div class="wrapper">

     		@include('layouts.top')

      		@include('layouts.sidebar')

	 		<!-- Content Wrapper. Contains page content -->
  			<div class="content-wrapper">
    
			<!-- Content Header (Page header) -->
    		@include('layouts.title', ['title' =>  'Data Barang'])
		    <!-- Main content -->
		    <section class="content">
      
      			<div class="row">

      				<div class="col-md-12">
        
	          			<div class="card">
	            
	            			<div class="card-header bg-light">
	              
	              				<h3 class="card-title">Barang <i class="nav-icon fas fa-truck ml-2"></i></h3>
	            				
	    					</div>
	        				<!-- /.card-header -->

	            			<div class="card-body">	

	            				<button class="button-s1 button-green mb-4" data-toggle="modal" data-target="#addModal">
    					
                                    Tambah Barang

                                </button>

                                <div class="modal fade" id="addModal">
                                    
                                    <div class="modal-dialog modal-lg">

                                        <div class="modal-content">

                                            <div class="modal-header">

                                                <h4 class="modal-title">Tambah Barang <i class="nav-icon fas fa-truck ml-2"></i></h4>

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                                    <span aria-hidden="true">&times;</span>
                                              
                                                </button>
                                                
                                            </div>

                                            <form id="add-product-supplier-form">

                                                @csrf

                                                <div class="modal-body">
                                                      
                                                      <p class="text-secondary font-weight-bold">[*] Wajib Diisi</p>

                                                      <div class="row">

                                                        <div class="col-md-6">

                                                            <div class="form-group">

                                                                <label class="modal-label">Nama *</label>

                                                                <br/>

                                                                <span class="text-danger add-ps-name-error"></span>

                                                                <input 
                                                                    type="text" 
                                                                    name="ps_name" 
                                                                    class="modal-input add-ps-name-modal-error" 
                                                                    placeholder="Nama Barang"
                                                                > 

                                                            </div>

                                                        </div>

                                                        <div class="col-md-6">

                                                            <div class="form-group">

                                                                <label class="modal-label">Kode *</label>

                                                                <br/>

                                                                <span class="text-danger add-ps-code-error"></span>

                                                                <input 
                                                                    type="text" 
                                                                    name="ps_code" 
                                                                    class="modal-input add-ps-code-modal-error" 
                                                                    placeholder="Kode Barang"
                                                                > 

                                                            </div>

                                                        </div>

                                                        <div class="col-md-6">

                                                            <div class="form-group">

                                                                <label class="modal-label">Harga *</label>

                                                                <br/>

                                                                <span class="text-danger add-ps-price-error"></span>

                                                                <input 
                                                                    type="text" 
                                                                    name="ps_price" 
                                                                    class="modal-input add-ps-price-modal-error" 
                                                                    placeholder="Harga Barang"
                                                                > 

                                                            </div>

                                                        </div>

                                                        <div class="col-md-6">

                                                            <div class="form-group">
        
                                                                <label class="modal-label">Penyuplai *</label>
        
                                                                <br/>
        
                                                                <span class="text-danger add-s-id-error"></span>
        
                                                                <select class="form-control select2bs4 add-s-id-modal-error" style="width: 100%;" name="s_id">
                                                                    
                                                                    <option value="">- Pilih Penyuplai -</option>

                                                                    @foreach($suppliers as $supplier)

                                                                        <option value="{{ $supplier->s_id }}">{{ $supplier->s_name }}</option>

                                                                    @endforeach

                                                                </select>
        
                                                            </div>
                                                            
                                                        </div>
                                                        <!-- /.col -->

                                                        <div class="col-md-6">

                                                            <div class="form-group">

                                                                <label for="ps_desc">Deskripsi</label>

                                                                <br/>

                                                                  <span class="text-danger add-ps-desc-address-error"></span>

                                                                  <textarea class="textarea-input add-ps-desc-modal-error" placeholder="Deskripsi Barang" name="ps_desc"></textarea>
                                                        
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
	              
	              				<table id="productSupplierTable" class="table table-hover">

                                    <div class="row mt-1 mb-2">

                                        <div class="col-md-4">
    
                                            <a href="{{ route('product-supplier-csv') }}" target="_blank" class="button-s1 button-grey mr-2"><i class="fas fa-file-csv mr-1"></i> Expor CSV</a>
    
                                            <a href="{{ route('product-supplier-excel') }}" target="_blank" class="button-s1 button-darkgreen mr-2"><i class="fas fa-file-excel mr-1"></i> Expor Excel</a>
    
                                            <a href="{{ route('product-supplier-pdf') }}" target="_blank" class="button-s1 button-darkorange mr-2"><i class="fas fa-file-pdf mr-1"></i> Expor PDF</a>
                                            
                                        </div>
    
                                        <form class="mt-5">
    
                                            <div class="col-md-3">
    
                                                <div class="form-group">
    
                                                    <label for="start_date">Tanggal Awal</label>
    
                                                    <input type="text" id="start_date" name="start_date" placeholder="Tanggal Awal" class="search-calendar ml-1">
    
                                                </div>
    
                                            </div>
    
                                            <div class="col-md-3">
    
                                                <div class="form-group">
    
                                                    <label for="end_date">Tanggal Akhir</label>
    
                                                    <input type="text" id="end_date" name="end_date" placeholder="Tanggal Akhir" class="search-calendar ml-1">
    
                                                </div>
    
                                            </div>
    
                                            <div class="col-md-2 d-flex align-items-start">
    
                                                <button type="reset" class="btn button-outline button-outline-black mr-2">Reset</button>
    
                                                <button class="btn button-outline button-outline-blue" id="btn-search-prodsupp">Cari</button>
    
                                            </div>	
    
                                        </form>
    
                                    </div>

	                				<thead>
	                
	                					<tr>
	                  				
	                						<th>Nama</th>

	                						<th>Kode</th>

	                  						<th>Harga</th>

                                            <th>Deskripsi</th>
                                              
	                  						<th>Penyuplai</th>

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

	@include('scripts/msupplier')

@endsection
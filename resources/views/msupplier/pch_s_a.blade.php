@extends('layouts.master')

@section('content')

	<body class="hold-transition sidebar-mini layout-fixed">

    	<div class="wrapper">

     		@include('layouts.top')

      		@include('layouts.sidebar')

	 		<!-- Content Wrapper. Contains page content -->
  			<div class="content-wrapper">

			<!-- Content Header (Page header) -->
    		@include('layouts.content_hd', ['title' => 'Tambah Pembelian Barang'])

		    <!-- Main content -->
		    <section class="content">

      			<div class="row">

      				<div class="col-md-12">

	          			<div class="card">

	            			<div class="card-header bg-success">

	              				<h3 class="card-title">Pembelian Barang <i class="nav-icon fas fa-truck ml-2"></i></h3>

	    					</div>
	        				<!-- /.card-header -->

	            			<div class="card-body">

	            				<p class="text-secondary font-weight-bold">[*] Wajib Diisi</p>

	            				<div>
                                    
                                    <div class="row">

                                        <div class="col-md-4">
                                            
                                            <div class="form-group">

												<label for="pch_code" class="modal-label">Kode Pembelian *</label>

												<br/>

												<span class="text-danger add-pch-code-error"></span>
    
                                                <input type="text" id="pch_code" name="pch_code" class="modal-input add-pch-code-modal-error" placeholder="Kode Pembelian">
    
                                            </div>
                                            
                                        </div>

			            				<div class="col-md-4">

			            					<div class="form-group">

												<label>Penyuplai *</label>

												<br/>

												<span class="text-danger add-s-id-error"></span>

												<select class="form-control select2bs4 add-s-id-modal-error" style="width: 100%;" id="s_id" name="s_id">

													<option value="" selected>- Pilih Penyuplai -</option>

													@foreach($suppliers as $supplier)

													<option value="{{ $supplier->s_id }}">{{ $supplier->s_name }}</option>

													@endforeach

												</select>

											</div>

										</div>  
										
										<div class="col-md-4">

											<div class="form-group">

												<label class="modal-label">Cari Barang</label>

												<div class="searchBar">
				   
													   <input id="purchasementInput" class="searchInput" type="text" placeholder="Cari Barang (Nama / Kode) ..." />
												
													<button class="searchSubmit" type="submit">
											  
														<svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#666666" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" /></svg>
										   
													</button>

												 </div>
												
											</div>

										</div>
                                    
									</div>
									
									<div class="row mt-2 mb-4">

										<div class="col-md-12">

											<div id="purchasement-shopping">
											
												<table id="purchasementList" class="table">

													<thead class="bg-light">
													
														<tr>

															<th>Barang</th>

															<th>Penyuplai</th>

															<th>Harga</th>
				
															<th>Jumlah</th>
				
															<th>Subtotal</th>
				
														</tr>
										
													</thead>
				
													<tbody></tbody>
				
												</table>

											</div>

											<div class="row">

												<div class="col-md-3">

													<h5 class="text-secondary">Total Bayar : </h5>

													<h3 id="total-purchasement">Rp 0</h3>

												</div>

												<div class="col-md-3">
													
													<div class="form-group">

														<label for="pch_tax" class="modal-label">Pajak</label>
														
														<br/>

														<span class="text-danger add-pch-tax-error"></span>
			
														<input type="text" id="pch_tax" name="pch_tax" value="0" class="modal-input add-pch-tax-modal-error" placeholder="Pajak Pembelian">
			
													</div>
													
												</div>
												
												<div class="col-md-3">
													
													<div class="form-group">

														<label for="pch_disc" class="modal-label">Diskon</label>
														
														<br/>

														<span class="text-danger add-pch-disc-error"></span>
			
														<input type="text" id="pch_disc" name="pch_disc" value="0" class="modal-input add-pch-disc-modal-error" placeholder="Diskon Pembelian">
			
													</div>
													
												</div>
												
												<div class="col-md-3">
													
													<div class="form-group">

														<label for="pch_ship" class="modal-label">Pengiriman</label>
														
														<br/>

														<span class="text-danger add-pch-ship-error"></span>
			
														<input type="text" id="pch_ship" name="pch_ship" value="0" class="modal-input add-pch-ship-modal-error" placeholder="Biaya Pengiriman">
			
													</div>
													
												</div>
												
												<div class="col-md-12 mt-3">

													<div class="form-group">

														<label for="pch_note">Catatan</label>

														<br/>

														<span class="text-danger edit-s-address-error"></span>

														<textarea class="textarea-input" placeholder="Catatan Pembelian" name="pch_note"></textarea>
												
													</div>

												</div>

											</div>

										</div>
										
									</div>

			            			<button id="btn-pay" class="button-s1 button-green" data-toggle="modal" data-target="#payModal">
    					
				    					Simpan

									</button>

									<div class="modal fade" id="payModal">
								        
								        <div class="modal-dialog modal-lg">

								          	<div class="modal-content">

								            	<div class="modal-header">

								              		<h4 class="modal-title">Tambah Pembelian Barang <i class="nav-icon fas fa-truck ml-2"></i></h4>

							              			<button type="button" class="close" data-dismiss="modal" aria-label="Close">

							                			<span aria-hidden="true">&times;</span>
							              		
							              			</button>
								            		
								            	</div>

								            	<form id="add-purchasement-supplier-form">

							            			<div class="modal-body">
														
														<p class="font-weight-bold mb-4">Konfirmasi Pembelian</p>

														<p id="total-pay">Total : </p>

														<p id="tax-pay">Pajak : </p>

														<p id="discount-pay">Diskon : </p>

														<p id="shipment-pay">Pengiriman : </p>
								            
								            		</div>
									            
									            	<div class="modal-footer justify-content-between">
									              
									              		<button type="button" class="button-s1 button-grey" data-dismiss="modal">Batal</button>
									              
								              			<button type="submit" class="button-s1 button-green">Beli</button>
									            	
									            	</div>

									            </form>
								          
								          	</div>
								          	<!-- /.modal-content -->
								        
								        </div>
								        <!-- /.modal-dialog -->
								      
								    </div>
								    <!-- /.modal -->
									
									<a class="button-s1 button-grey" href="{{ url('supplier/purchasement') }}">Kembali</a>	

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

	@include('layouts/scripts/msupplier')

@endsection
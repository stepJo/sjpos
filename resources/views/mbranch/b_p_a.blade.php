@extends('layouts.master')

@section('content')

	<body class="hold-transition sidebar-mini layout-fixed">

    	<div class="wrapper">

     		@include('layouts.top')

      		@include('layouts.sidebar')

	 		<!-- Content Wrapper. Contains page content -->
  			<div class="content-wrapper">

			<!-- Content Header (Page header) -->
    		@include('layouts.title', ['title' => 'Tambah Produk Diaktivasi'])

		    <!-- Main content -->
		    <section class="content">

      			<div class="row">

      				<div class="col-md-10">

	          			<div class="card">

	            			<div class="card-header bg-success">

	              				<h3 class="card-title">Produk Diaktivasi <i class="nav-icon fas fa-store ml-2"></i></h3>

	    					</div>
	        				<!-- /.card-header -->

	            			<div class="card-body">

	            				<p class="text-secondary font-weight-bold">[*] Wajib Diisi</p>


								<form id="add-branch-product-form">

									<div class="row">

										<div class="col-md-6">

											<div class="form-group">

												<label>Cabang *</label>

												<br/>

												<span class="text-danger add-b-id-error"></span>

												<select class="form-control select2bs4 add-b-id-modal-error" style="width: 100%;" id="b_id" name="b_id">

													<option value="" selected>- Pilih Cabang -</option>

													@foreach($branches as $branch)

														<option value="{{ $branch->b_id }}">{{ $branch->b_name }}</option>

													@endforeach

												</select>

											</div>

										</div>  
										
										<div class="col-md-6">

											<div class="form-group">

												<label class="modal-label">Cari Produk</label>

												<div class="searchBar">
				
													<input id="branchProductInput" class="searchInput" type="text" placeholder="Cari Produk (Nama / Kode) ..." />
												
													<button class="searchSubmit" type="submit">
											
														<svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#666666" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" /></svg>
										
													</button>

												</div>
												
											</div>

										</div>
									
									</div>
									
									<div class="row mt-2 mb-4">

										<div class="col-md-12">

											<div id="branch-product-list">
											
												<table id="branchProductList" class="table">

													<thead class="bg-light">
													
														<tr>

															<th>Produk</th>

															<th>Harga</th>

															<th></th>
															
														</tr>
										
													</thead>
				
													<tbody></tbody>
				
												</table>

											</div>

										</div>
										
									</div>

									<button id="btn-disactive" class="button-s1 button-green">
						
										Simpan

									</button>

									<a class="button-s1 button-grey" href="{{ url('branch/product') }}">Kembali</a>	

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

@section('script')

	@include('scripts/mbranch')

@endsection
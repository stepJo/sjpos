@extends('layouts.master')

@section('content')
	
	<body onload="startTime()" class="receipt hold-transition sidebar-mini layout-fixed sidebar-collapse">

		@include('layouts.pos_top')
      			
		@include('layouts.sidebar')

      	<div class="container-fluid">

			<div class="row mt-2">

				<div class="col-md-6">

					<div class="row mt-2">
							
						<div class="col-md-12">

							<div class="searchBar">
						   	
					  	 		<input id="posInput" class="searchInput" type="text" placeholder="Cari Produk (Nama / Kode) ..." />
						    
					    		<button class="searchSubmit" type="submit">
					      
					      			<svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#666666" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" />
					      			
					      			</svg>
					   
					   	 		</button>

						 	</div>

						</div>

						<div class="col-md-12">

							<div class="row mt-2">

								<button class="button-s2 btn-category">Kategori</button>

								<div id="panel-category" class="bg-light">
									
									<div class="row mt-2">

										<div class="col-md-6 d-flex align-content-center">

											<h4 class="ml-3 font-weight-bold">Pilih Kategori</h4>

										</div>

										<div class="col-md-6 d-flex justify-content-end align-content-center">

											<button class="mr-3 show-all-product">Semua Produk</button>

											<div class="close-icon"></div>

										</div>

									</div>

									<div class="row mt-5 ml-5">

										@foreach($categories as $category)

											<div class="col-md-2 ml-3 mt-4">

												<div class="filter-category" data-category="{{ $category->cat_id }}">

													<h6 class="font-weight-bold">{{ $category->cat_name }}</h6>

													<span class="text-secondary font-weight-bold">{{ $category->products->count() }} produk</span>

												</div>

											</div>

										@endforeach
										
									</div>

								</div>

								<button class="button-s2 btn-unit">Satuan</button>

								<div id="panel-unit" class="bg-light">
									
									<div class="row mt-2">

										<div class="col-md-6 d-flex align-content-center">

											<h4 class="ml-3 font-weight-bold">Pilih Satuan</h4>

										</div>

										<div class="col-md-6 d-flex justify-content-end align-content-center">

											<button class="mr-3 show-all-product">Semua Produk</button>

											<div class="close-icon"></div>

										</div>

									</div>

									<div class="row mt-5 ml-5">

										@foreach($units as $unit)

											<div class="col-md-2 ml-3 mt-4">

												<div class="filter-unit" data-unit="{{ $unit->unit_id }}">

													<h6 class="font-weight-bold">{{ $unit->unit_name }}</h6>

													<span class="text-secondary font-weight-bold">{{ $unit->products->count() }} produk</span>

												</div>

											</div>

										@endforeach
										
									</div>

								</div>	

							</div>

							<div class="row mt-3">

								<div class="col-md-6 d-flex align-items-baseline">	

									<i class="fas fa-clock mr-1"></i>

									<p id="clock"></p>

								</div>

								<div class="col-md-6 d-flex justify-content-end">

									<p>

										Total Produk : {{ count($products) }} 

										@if($not_actives > 0)

											( <span class="text-danger font-italic">{{ $not_actives }} tidak aktif</span> )

										@endif

									</p>

								</div>
							
							</div>

							<div class="product-grid">

								@foreach($products as $product)

									<div class="product-card" id="product-data-{{ $product->p_id }}">

										<div class="product-thumb">
												
											@if($product->p_status == 0)

												<div class="layer-off">
													
													<p>Tidak Aktif</p>

												</div>

											@endif

											{!! Utilities::renderImage('products', $product->p_image) !!}

										</div>
										
										<div class="product-details">

											<span class="product-code" data-code="{{ $product->p_code }}">

												{{ $product->p_code }}

											</span>
											
											<h4 class="product-name" data-name="{{ $product->p_name }}">

												{{ $product->p_name }}

											</h4>
											
											<div class="product-bottom-details">
												
												<div class="product-price">

													@if($product->discount['dp_value'] != '' && $product->discount['dp_status'] == 1)

														<span class="price-cut">{{ Utilities::rupiahFormat($product->p_price) }}</span>

														<div class="product-price-promo">

															<span class="cost-price"  data-price={{ $product->p_price - $product->discount['dp_value'] }}>

																{{ Utilities::rupiahFormat($product->p_price - $product->discount['dp_value']) }}

															</span>

														</div>

													@else

														<span class="cost-price"  data-price={{ $product->p_price }}>

															{{ Utilities::rupiahFormat($product->p_price) }}

														</span>

													@endif

												</div>
	
											</div>

										</div>

										@if($product->p_status == 1)

											<button class="add-item button-s1 btn-dark mt-2 mb-2" data-product="{{ $product->p_id }}">Pilih</button>

										@endif

									</div>

								@endforeach	
				
							</div>

						</div>

						<div class="col-md-6">

							<div id="payment-selection">

								<div class="row">
		
									<div class="col-md-12">
		
										<button class="button-s2 btn-cash" data-target="#payModal">Tunai</button>
		
										<button class="button-s2 btn-credit" data-target="#payModal">Kartu Kredit</button>
			
										{{-- <button class="button-s2 btn-ovo" data-target="#payModal">OVO</button>
		
										<button class="button-s2 btn-gopay" data-target="#payModal">Gopay</button> --}}
		
										<div class="modal fade" id="payModal" tabindex="-1" role="dialog"aria-hidden="true">
										
											<div class="modal-dialog modal-dialog-scrollable modal-lg">
											
												<div class="modal-content">
											
													<div class="modal-header">
												
														<h5 class="modal-title font-weight-bold">Bayar</h5>
												
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												
															<span aria-hidden="true">&times;</span>
												
														</button>
											
													</div>
											
													<div class="modal-body">
		
														<table class="table table-hover">
		
															<thead>
		
																<th>Produk</th>
		
																<th>Jumlah</th>
		
																<th>Harga</th>
		
																<th>Sub Total</th>
		
															</thead>
		
															<tbody>
																
															</tbody>
		
														</table>
		
														<div class="row my-2">
		
															<div class="col-md-7">
		
																<h6 id="modal-grand-total" class="font-weight-bold"></h6>
															
															</div>
															
															<div class="col-md-5 d-flex justify-content-end">

																<h6 id="modal-tax" class="font-weight-bold text-danger"></h6>

															</div>

															{{-- <div class="col-md-3 d-flex justify-content-end">
		
																<p>
		
																	Pisah Tagihan
		
																	<div class="ckbx-style-16 ml-2">
																		
																		<input type="checkbox" id="ckbx-style-16-1" value="0" name="ckbx-style-16">
		
																		<label for="ckbx-style-16-1"></label>
		
																	</div>
		
																</p>
		
															</div> --}}
		
														</div>
		
														<div class="row my-2">
		
															<div class="col-md-12">
		
																<p>
		
																	Diskon
		
																	<input type="radio" name="discount" id="fix-dc" value="Nominal" class="ml-4" />
		
																	<label class="discount-label" for="fix-dc">Nominal</label>
																	
																	<input type="radio" name="discount" id="percent-dc" value="Persen" class="ml-2" />
																	
																	<label class="discount-label" for="percent-dc">Persen</label>
		
																	<input type="text" id="fix-disc-amount" placeholder="Nominal" class="modal-input" name="nominal_value">
		
																	<input type="text" id="percent-disc-amount" placeholder="Persen" class="modal-input" name="percent_value">
		
																	<input type="hidden" id="percent_value_amount" name="percent_value_amount">
		
																</p>
		
															</div>
		
														</div>
		
														<div class="row">
		
															<div class="col-md-12">
		
																<div class="pay-tabs">
		
																	<div data-pws-tab="tab1" data-pws-tab-name="Tunai" data-pws-tab-icon="fas fa-money-bill-alt">
																		
																		<div class="row">
		
																			<div class="col-md-6">
		
																				<p>
		
																					Bayar : 
		
																					<input type="text" id="pay-amount" placeholder="Nominal" class="modal-input mt-1">
		
																					<input type="hidden" name="t_total" id="t_total">
		
																				</p>
		
																			</div>
		
																			<div class="col-md-6">
		
																				<p>
		
																					Kembalian : 
		
																					<input type="text" id="return-amount" placeholder="Nominal" class="modal-input mt-1" disabled>
		
																				</p>
		
																			</div>
		
																		</div>
		
																	</div>
		
																	<div data-pws-tab="tab2" data-pws-tab-name="Kartu Kredit" data-pws-tab-icon="fas fa-credit-card">
																		
																		<div class="row">
		
																			<div class="col-md-6">
		
																				<p>
		
																					Nomor : 
		
																					<input type="text" placeholder="Nomor Kartu Kredit" class="modal-input mt-1" id="credit-card-number">
		
																				</p>
		
																			</div>
		
																			<div class="col-md-6">
		
																				<p>
		
																					CVC : 
		
																					<input type="text" placeholder="Nomor CVC" class="modal-input mt-1" id="credit-card-cvc">
		
																				</p>
		
																			</div>
		
																		</div>
		
																	</div>
		
																</div>
		
															</div>
		
														</div>
		
														<div class="row d-flex justify-content-end">
		
															<button type="button" class="button-s2 button-grey" data-dismiss="modal">Batal</button>
													
															<button type="button" id="btn-pay" class="button-s2 button-darkorange">Bayar</button>
		
														</div>
		
													</div>
												
												</div>
										
											</div>
										
										</div>
		
									</div>
		
								</div>
		
							</div>

						</div>

					</div>

				</div>

				<div class="col-md-6">
					
					<div class="row d-flex align-items-center">

						<div class="col-md-8">

							<div class="form-group">
	
								<label>Pelanggan</label>
	
								<select class="form-control select2bs4" id="customer-list" style="width: 100%;" name="c_id">
									
									<option value="">Walk In</option>
	
									@foreach($customers as $customer)
	
										<option value="{{ $customer->c_id }}">{{ $customer->c_name }}</option>
	
									@endforeach
	
								</select>
	
							</div>
							
						</div>

						<div class="col-md-4 mt-3">

							<button class="button-s1 button-green" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Tambah pelanggan</button>

							<div class="modal fade" id="addModal">
                                        
								<div class="modal-dialog">

									<div class="modal-content">

										<div class="modal-header">

											<h4 class="modal-title">Tambah Pelanggan <i class="nav-icon far fa-grin ml-2"></i></h4>

											<button type="button" class="close" data-dismiss="modal" aria-label="Close">

												<span aria-hidden="true">&times;</span>
										
											</button>
											
										</div>

										<form id="add-customer-form">

											<div class="modal-body">
												
												<p class="text-secondary font-weight-bold">[*] Wajib Diisi</p>

												<div class="row">

													<div class="col-md-12">

														<div class="form-group">

															<label class="modal-label">Nama *</label>

															<br/>

															<span class="text-danger add-c-name-error"></span>

															<input 
																type="text" 
																name="c_name" 
																id="c_name"
																class="modal-input add-c-name-modal-error" 
																placeholder="Nama Pelanggan"
															> 

														</div>

														<div class="form-group">

															<label class="modal-label">Email</label>

															<br/>

															<span class="text-danger add-c-email-error"></span>

															<input 
																type="email" 
																name="c_email" 
																id="c_email"
																class="modal-input add-c-email-modal-error" 
																placeholder="Email Pelanggan"
															> 

														</div>

														<div class="form-group">

															<label class="modal-label">Kontak</label>

															<br/>

															<span class="text-danger add-c-contact-error"></span>

															<input 
																type="text" 
																name="c_contact" 
																id="c_contact"
																class="modal-input add-c-contact-modal-error" 
																placeholder="Kontak Pelanggan"
															> 

														</div>
														
														<div class="form-group">

															<label class="modal-label">Alamat</label>

															<br/>

															<span class="text-danger add-c-address-error"></span>

															<textarea class="textarea-input add-c-address-modal-error" placeholder="Alamat Pelanggan" id="c_address" name=c_address"></textarea>
													
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

						</div>

					</div>

					<div class="row">

						<div class="col-md-12">

							<div id="product-shopping">

								<table id="productList" class="table">

									<thead class="bg-indigo">
									
										<tr>
										
											<th>Produk</th>

											<th>Harga</th>

											<th>Jumlah</th>

											<th>Subtotal</th>

										</tr>
						
									</thead>

									<tbody></tbody>

								</table>

							</div>

						</div>

			    	</div>

			    	<div class="row mt-2">

			    		<div class="col-md-12">

			    			<div id="payment">
			    				
				    			<table class="table table-hover">

					    			<thead>

					    				<tr>
					    					
					    					<td>

					    						<p class="font-weight-bold text-dark mb-1 mt-1">	
					    							Total Produk
					    						
					    						</p>

					    					</td>

					    					<td class="d-flex justify-content-end pr-5">

					    						<p id="total-product" class="font-weight-bold mb-2 mt-1">0</p>

					    					</td>

					    				</tr>

					    				<tr>
					    					
					    					<td>

					    						<p class="font-weight-bold text-dark mb-1 mt-1">	
					    							Sub Total
					    						
					    						</p>

					    					</td>

					    					<td class="d-flex justify-content-end pr-5">

					    						<p id="subtotal" class="font-weight-bold mb-1 mt-1">Rp 0</p>

					    					</td>

					    				</tr>

					    				<tr>
					    					
					    					<td>

					    						<p class="font-weight-bold text-dark mb-1 mt-1">

					    							Pajak

					    						</p>

					    					</td>

					    					<td class="d-flex justify-content-end pr-5">

					    						<p id="tax" class="font-weight-bold mb-2 mt-1">10%</p>

					    					</td>

					    				</tr>

					    				<tr>
					    					
					    					<td>

					    						<h5 class="font-weight-bold text-secondary">

					    							Total Bayar

					    						</h5>

					    					</td>

					    					<td class="d-flex justify-content-end pr-5">

					    						<h5 id="grand-total" class="mt-2 font-weight-bold text-secondary">

					    							Rp 0

					    						</h5>

					    					</td>
					    					
					    				</tr>

				    				</thead>

				    			</table>

				    		</div>

				    	</div>

				    </div>

				</div>

			</div>

		</div>
	 
		<div class="calculator">

			<div class="calc-close-icon"></div>
			
			<textarea class="calc-display-prev" rows="1" value="" wrap="off" disabled></textarea>

			<textarea class="calc-display" rows="1" wrap="off" disabled>0</textarea>

			<div class="calc-keys">
					
				<button type="button" value="7">7</button>
			
				<button type="button" value="8">8</button>
			
				<button type="button" value="9">9</button>
			
				<button type="button" class="key-op" data-action="divide" title="Divide [/]" value="/">&divide;</button>

			
				<button type="button" class="key-pi" title="Pi" value="&pi;">&pi;</button>
			
				<button type="button" value="4">4</button>
			
				<button type="button" value="5">5</button>
			
				<button type="button" value="6">6</button>
			
				<button type="button" class="key-op" data-action="multiply" title="Multiply [*]" value="*">&times;</button>
			
				<button type="button" class="key-pf" data-action="prime-factorization" title="Prime Factorization" value="PF">PF</button>
			
				<button type="button" value="1">1</button>
			
				<button type="button" value="2">2</button>
			
				<button type="button" value="3">3</button>
			
				<button type="button" class="key-op" data-action="subtract" title="Subtract [-]" value="-">-</button>
			
				<button type="button" class="key-op" data-action="modulo" title="Modulus Divide [%]" value="%">mod</button>

				<button type="button" class="all-clear" data-action="clear" title="Clear Display" value="all-clear">AC</button>
			
				<button type="button" value="0">0</button>
			
				<button type="button" class="decimal" data-action="decimal" value=".">.</button>
			
				<button type="button" class="key-op" data-action="add" title="Add [+]" value="+">+</button>            
			
				<button type="button" class="equal-sign" data-action="calculate" title="Calculate Result" value="=">=</button>

			</div>
		  
		</div>

	</body>

@endsection

@section('script')

	@include('scripts/pos')

@endsection
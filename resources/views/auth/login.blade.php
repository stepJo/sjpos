@extends('layouts.master')

@section('content')
	
	<body class="hold-transition login-page">
		
		<div class="login-box">
  
  			<div class="login-logo">
				  
    			<b>SJPOS</b>
  
  			</div>
  			<!-- /.login-logo -->
  
			<div class="card">

				<div class="card-body login-card-body">
  
  					<p class="login-box-msg font-weight-bold">Login</p>

  					<form action="{{ url('auth/check') }}" method="POST">
    	
  						@csrf	

						<div class="row">
						
							<div class="col-md-12">

								<div class="form-group">

									@error('b_id')

										<span class="text-danger"> {{ $message }}</span>

									@enderror

									<select class="form-control select2bs4 {{ $errors->has('b_id') ? ' is-invalid' : '' }}" style="width: 100%;" name="b_id">
										
										<option value="">- Pilih Cabang -</option>

										@foreach($branches as $branch)

											@if(old('b_id') == $branch->b_id)

												<option value="{{ $branch->b_id }}" selected>{{ $branch->b_name }}</option>

											@else

												<option value="{{ $branch->b_id }}">{{ $branch->b_name }}</option>

											@endif

										@endforeach

									</select>

								</div>
								
							</div>

						</div>

						<div class="row">
						
							<div class="col-md-12">

								<div class="form-group">

									@error('role_id')

										<span class="text-danger"> {{ $message }}</span>

									@enderror

									<select class="form-control select2bs4 {{ $errors->has('role_id') ? ' is-invalid' : '' }}" style="width: 100%;" name="role_id">
										
										<option value="">- Pilih Role -</option>

										@foreach($roles as $role)

											@if(old('role_id') == $role->role_id)

												<option value="{{ $role->role_id }}" selected>{{ $role->role_name }}</option>

											@else

												<option value="{{ $role->role_id }}">{{ $role->role_name }}</option>

											@endif

										@endforeach

									</select>

								</div>
								
							</div>

						</div>

						@error('u_email')

							<span class="text-danger"> {{ $message }}</span>

						@enderror

    					<div class="input-group mb-3">

      						<input type="email" class="form-control {{ $errors->has('u_email') ? ' is-invalid' : '' }}" name="u_email" placeholder="Email User" value="{{ old('u_email') }}">
      			
								<div class="input-group-append">
    
    							<div class="input-group-text">
      	
      								<span class="fas fa-envelope"></span>
    	
    							</div>
  
  							</div>
    
						</div>

						@error('u_password')

		        			<span class="text-danger"> {{ $message }}</span>

		        		@enderror

				        <div class="input-group mb-3">

				          	<input type="password" class="form-control {{ $errors->has('u_password') ? ' is-invalid' : '' }}" name="u_password" placeholder="Password User">
				          	
				          	<div class="input-group-append">

				            	<div class="input-group-text">

				              		<span class="fas fa-lock"></span>

				            	</div>

				          	</div>

				        </div>
    					
    					<div class="row">
      
				          	<div class="col-md-12">
				            
				            	<button type="submit" class="btn btn-primary bg-indigo btn-block">Masuk</button>
				          
				          	</div>
				            <!-- /.col -->
    					
    					</div>
  				
  					</form>

			 	</div>
				<!-- /.login-card-body -->

			</div>

		</div>
		<!-- /.login-box -->

@endsection
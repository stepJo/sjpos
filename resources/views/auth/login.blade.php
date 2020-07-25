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
				            
				            	<button type="submit" class="btn btn-primary bg-indigo btn-block">Login</button>
				          
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
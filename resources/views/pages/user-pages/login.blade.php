@extends('layout.master-mini')
@section('content')

<div class="content-wrapper d-flex align-items-center justify-content-center auth theme-one" style="background-image: url({{ url('assets/images/auth/login_3.jpg') }}); background-size: cover;">
	<div class="row w-100">
	  <div class="col-lg-4 mx-auto">
		<div class="auto-form-wrapper">
		  <form action="" method="POST">
			{{ csrf_field() }}
			<span class="login100-form-title p-b-49">
						  Login
					  </span>
  
					  <div class="form-group">
						<label class="label">Username</label>
						<div class="input-group">
						  <input type="text" name="txtUser" class="form-control" placeholder="Username">
						  <div class="input-group-append">
							<span class="input-group-text">
							  <i class="mdi mdi-check-circle-outline"></i>
							</span>
						  </div>
						</div>
					  </div>
  
					  <div class="form-group">
						<label class="label">Password</label>
						<div class="input-group">
						  <input type="password" name="txtPass" class="form-control" placeholder="*********">
						  <div class="input-group-append">
							<span class="input-group-text">
							  <i class="mdi mdi-check-circle-outline"></i>
							</span>
						  </div>
						</div>
					  </div>
					  
					  <div class="text-right p-t-8 p-b-31">
					  </div>
					  
					  <div class="container-login100-form-btn">
						  <div class="wrap-login100-form-btn">
							  <div class="login100-form-bgbtn"></div>
							  <button class="login100-form-btn">
								  Login
							  </button>
						  </div>
					  </div>
  
					  <div class="txt1 text-center p-t-54 p-b-20">
						  <span>
						  </span>
					  </div>
  
					  <div class="flex-c-m">
					  </div>
			
		  </form>
		</div>
		<ul class="auth-footer">
		  <li>
			<a href="#">Conditions</a>
		  </li>
		  <li>
			<a href="#">Help</a>
		  </li>
		  <li>
			<a href="#">Terms</a>
		  </li>
		</ul>
	  </div>
	</div>
  </div>

@endsection
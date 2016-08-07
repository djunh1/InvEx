@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">Login</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Form Error! </strong> Please check the login form.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif


						<form class="login-form" action="{{ url('/auth/login') }}" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<h3 class="form-title">Login to your account</h3>
							<div class="alert alert-danger display-hide">
								<button class="close" data-close="alert"></button>
								<span> Enter any username and password. </span>
							</div>
							<div class="form-group">
								<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
								<label class="control-label visible-ie8 visible-ie9">Email Address</label>
								<div class="input-icon">
									<i class="fa fa-user"></i>
									<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email Address" name="email" value="{{ old('email') }}"> </div>
							</div>
							<div class="form-group">
								<label class="control-label visible-ie8 visible-ie9">Password</label>
								<div class="input-icon">
									<i class="fa fa-lock"></i>
									<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
							</div>
							<div class="form-actions">
								<label class="rememberme mt-checkbox mt-checkbox-outline">
									<input type="checkbox" name="remember" value="1" /> Remember me
									<span></span>
								</label>
								<button type="submit" class="btn green pull-right"> Login </button>
							</div>
							<div class="login-options">
								<h4>Or login with</h4>
								<ul class="social-icons">
									<li>
										<a class="facebook" data-original-title="facebook" href="{{ url('/auth/facebook') }}"> </a>
									</li>
									<li>
										<a class="twitter" data-original-title="Twitter" href="{{ url('/auth/twitter') }}"> </a>
									</li>
									<li>
										<a class="googleplus" data-original-title="Goole Plus" href="{{ url('/auth/google') }}"> </a>
									</li>
									<li>
										<a class="github" data-original-title="Linkedin" href="javascript:;"> </a>
									</li>
								</ul>
							</div>
							<div class="forget-password">
								<h4>Forgot your password ?</h4>
								<p> Please go
									<a href="{{ url('/password/email') }}" id="forget-password"> here </a> to reset your password. </p>
							</div>
							<div class="create-account">
								<p> Don't have an account yet ?&nbsp;
									<a href="{{ url('/auth/register') }}" id="register-btn"> Create an account </a>
								</p>
							</div>
						</form>


					<!-- OLD FORM
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Login</button>

								<a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>
							</div>
						</div>
					</form-->


				</div>
			</div>
		</div>
	</div>
</div>
@endsection

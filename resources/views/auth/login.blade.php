@extends('layouts.index')

@section('content')
<body class="login-page">
<div class="login-box">
	<div class="logo">
		<a href="javascript:void(0);">Dashboard</b></a>
	</div>
	<div class="card">
		<div class="body">
			<form id="sign_in" method="POST">
				@if($errors->has())
				<div class="msg">
					<ul>
				    @foreach ($errors->all() as $error)
				      <li>{{ $error }}</li>
				  	@endforeach
				  </ul>
				</div>
				@endif

				@if((isset($error)) && ($error == 1))
    				<div class="msg" style="background:red;color:white">Invalid username and password</div>
    			@else
    				<div class="msg"></div>
				@endif

				<div class="input-group">
					<span class="input-group-addon">
						<i class="material-icons">person</i>
					</span>
					<div class="form-line">
						<input type="text" class="form-control" name="username" placeholder="Username" required autofocus autocomplete="off">
					</div>
				</div>
				<div class="input-group">
					<span class="input-group-addon">
						<i class="material-icons">lock</i>
					</span>
					<div class="form-line">
						<input type="password" class="form-control" name="password" placeholder="Password" required autocomplete="off">
					</div>
					<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
				</div>
				<div class="row">
					<div class="col-xs-8 p-t-5">
						<input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
						<label for="rememberme">Remember Me</label>
					</div>
					<div class="col-xs-4">
						<button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection

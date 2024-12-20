@extends('layouts.auth')

@section('content')
<div class="col-12">
	<div class="row justify-content-center g-0">
		<div class="col-lg-5 col-md-5 col-12">
			<div class="bg-white rounded10 shadow-lg">
				<div class="p-40">
					<form method="POST" action="{{ route('login') }}">
						@csrf
						<div class="form-group">
							<div class="input-group mb-3">
								<span class="input-group-text bg-transparent"><i class="text-fade ti-user"></i></span>
								<input type="text" class="form-control ps-15 bg-transparent @error('email') is-invalid @enderror" placeholder="{{ __('Email Address') }}" name="email" value="{{ old('email') }}" required>
								@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<span class="input-group-text  bg-transparent"><i class="text-fade ti-lock"></i></span>
								<input id="password" type="password" class="form-control ps-15 bg-transparent @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" name="password" required>
								@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<div class="checkbox">
									<input type="checkbox" id="remember" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
									<label for="basic_checkbox_1">Relembrar</label>
								</div>
							</div>
							<div class="col-6">
								<div class="fog-pwd text-end">
									<a href="{{ route('password.request') }}" class="text-primary fw-500 hover-primary"><i class="ion ion-locked"></i> Recuperar password!</a><br>
								</div>
							</div>
							<div class="col-12 text-center">
								<button type="submit" class="btn btn-primary w-p100 mt-10">Login</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
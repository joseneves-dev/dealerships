@extends('layouts.auth')

@section('content')
<div class="col-12">
	<div class="row justify-content-center g-0">
		<div class="col-lg-5 col-md-5 col-12">
			<div class="bg-white rounded10 shadow-lg">
				<div class="content-top-agile p-20 pb-0">
					<h2 class="mb-10 fw-600 text-primary">Recuperar password</h2>
					<p class="mb-0 text-fade">Insira o email para recuperar a password</p>
				</div>
				<div class="p-40">
					@if (session('status'))
					<div class="alert alert-success" role="alert">
						{{ session('status') }}
					</div>
					@endif
					<form method="POST" action="{{ route('password.email') }}">
						@csrf
						<div class="form-group">
							<div class="input-group mb-3">
								<span class="input-group-text bg-transparent"><i class="text-fade ti-email"></i></span>
								<input id="email" type="email" class="form-control ps-15 bg-transparent @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
								@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>
						<div class="row">
							<div class="col-12 text-center">
								<button type="submit" class="btn btn-primary w-p100 mt-10">Enviar link para alterar</button>
							</div>
						</div>
						<div class="row">
							<div class="col-12 text-center mt-5">
								<a href="{{ route('login') }}" class="text-primary fw-500 hover-primary"><i class="ion ion-locked"></i> Voltar para Login!</a><br>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
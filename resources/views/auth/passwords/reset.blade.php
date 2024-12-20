@extends('layouts.auth')

@section('content')
<div class="col-12">
    <div class="row justify-content-center g-0">
        <div class="col-lg-5 col-md-5 col-12">
            <div class="bg-white rounded10 shadow-lg">
                <div class="content-top-agile p-20 pb-0">
                    <h2 class="text-primary fw-600">{{ __('Reset Password') }}</h2>
                </div>
                <div class="p-40">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-transparent"><i class="text-fade ti-user"></i></span>
                                <input id="email" type="email" name="email" class="form-control ps-15 bg-transparent @error('email') is-invalid @enderror" placeholder="E-mail" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-transparent"><i class="text-fade ti-user"></i></span>
                                <input id="password" type="password" type="text" name="password" required class="form-control ps-15 bg-transparent  @error('password') is-invalid @enderror" placeholder="Password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <span class="input-group-text  bg-transparent"><i class="text-fade ti-lock"></i></span>
                                <input id="password-confirm" type="password" class="form-control ps-15 bg-transparent" name="password_confirmation" required placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary w-p100 mt-10">{{ __('Reset Password') }}</button>
                            </div>
                        </div>
                    </form>
                    <div class="text-center">
                        <p class="mt-15 mb-0 text-fade">Tem conta? <a href="{{ route('login') }}" class="text-primary ms-5">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-lg-8 col-12 mx-auto">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Concessionária</h4>
                </div>
                <form class="form" method="POST" action="{{ route('editDealershipEntry', ['id' => $data->id]) }}">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Nome</label>
                                    <input name="name" id="name" type="text" value="{{ $data->user->name }}" required class="form-control  @error('name') is-invalid @enderror">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Nif</label>
                                    <input name="tax_number" id="tax_number" type="text" value="{{  $data->tax_number }}" required class="form-control  @error('tax_number') is-invalid @enderror">
                                    @error('tax_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Morada</label>
                                    <input name="address" id="address" type="text" value="{{  $data->address }}" required class="form-control  @error('address') is-invalid @enderror">
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Localidade</label>
                                    <input name="locale" id="locale" type="text" value="{{  $data->locale }}" required class="form-control  @error('locale') is-invalid @enderror">
                                    @error('locale')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Código postal</label>
                                    <input name="zip" id="zip" type="text" value="{{  $data->zip }}" required class="form-control  @error('zip') is-invalid @enderror">
                                    @error('zip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Telémovel</label>
                                    <input name="phone" id="phone" type="text" value="{{  $data->phone }}" required class="form-control  @error('phone') is-invalid @enderror">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">E-mail</label>
                                    <input name="email" id="email" type="email" value="{{  $data->user->email }}" required class="form-control  @error('email') is-invalid @enderror">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Password</label>
                                    <input name="password" id="password" type="text" class="form-control  @error('password') is-invalid @enderror">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="box-footer text-end">
                        <a href="{{route('viewDealerships')}}" class="btn btn-primary-light me-1">
                            <i class="ti-trash"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti-save-alt"></i> Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
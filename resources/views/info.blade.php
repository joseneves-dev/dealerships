@extends('layouts.app')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-8 mx-auto">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Dados Concessionária</h4>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="form-group">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control" readonly="" disabled="" value="{{$data->name}}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="form-group">
                                <label class="form-label">Nif</label>
                                <input type="text" class="form-control" readonly="" disabled="" value="{{$data->dealership->tax_number}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 col-12">
                            <div class="form-group">
                                <label class="form-label">Morada</label>
                                <input type="text" class="form-control" readonly="" disabled="" value="{{$data->dealership->address}}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="form-group">
                                <label class="form-label">Localidade</label>
                                <input type="text" class="form-control" readonly="" disabled="" value="{{$data->dealership->locale}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-12">
                            <div class="form-group">
                                <label class="form-label">Código Postal</label>
                                <input type="text" class="form-control" readonly="" disabled="" value="{{$data->dealership->zip}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-12">
                            <div class="form-group">
                                <label class="form-label">Telefone</label>
                                <input type="text" class="form-control" readonly="" disabled="" value="{{$data->dealership->phone}}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="form-group">
                                <label class="form-label">E-mail</label>
                                <input type="email" class="form-control" readonly="" disabled="" value="{{$data->email}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
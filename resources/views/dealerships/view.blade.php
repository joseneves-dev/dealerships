@extends('layouts.app')

@section('content')
<section class="content">
    <div class="row mb-10">
        <div class="col-12">
            <div class="clearfix ">
                <a href="{{ route('newDealership') }}" class="waves-effect waves-light btn btn-primary btn-default  float-end">Nova Concessionária</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="dealership" class="text-fade table table-bordered display" style="width:100%">
                            <thead>
                                <tr class="text-dark">
                                    <th>Nome</th>
                                    <th>Nif</th>
                                    <th>Morada</th>
                                    <th>Email</th>
                                    <th data-orderable="false"></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($dealerships as $dealership)
                                <tr>
                                    <td class="text-dark">{{$dealership->user->name}}</td>
                                    <td>{{$dealership->tax_number}}</td>
                                    <td>{{$dealership->address}}</td>
                                    <td>{{$dealership->user->email}}</td>
                                    <td>
                                        <a href="{{ route('editDealership', ['id' => $dealership->id]) }}" class="waves-effect waves-light btn btn-primary mb-5">Editar</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('scripts')

<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>

<script>
    $('#dealership').DataTable();
</script>
@endpush
@endsection
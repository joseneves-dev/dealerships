@extends('layouts.app')

@section('content')
<style>
    .select2-selection {
        padding-left: 5px;
        padding-top: 2px;
        height: 40px !important;
        background-color: #ffffff !important;
    }

    input::placeholder {
        color: #adb5bd;
    }

    .datepicker {
        background-color: #ffffff !important;
    }
</style>
<section class="content">
    <div class="row mb-10">
        <div class="col-3">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right datepicker" id="dateRange" name="dateRange" placeholder="Selecione Datas">
                </div>
            </div>
        </div>
        @if(Auth::user()->admin == 1)
        <div class="col-4">
            <div class="form-group">
                <select id="dealership" class="form-control select2" multiple="multiple" style="width: 100%;">
                    @foreach($dealerships as $dealership)
                    <option value="{{ $dealership->id }}">{{$dealership->user->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @endif
        <div class="col-2">
            <button id="filterData" type="submit" class="btn btn-primary">Pesquisar</button>
        </div>
        <div class="col-2 ms-auto">
            <div class="clearfix ">
                <a href="{{ route('newContract') }}" class="waves-effect waves-light btn btn-primary btn-default  float-end">Novo Contrato</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="contracts" class="text-fade table table-bordered display" style="width:100%">
                            <thead>
                                <tr class="text-dark">
                                    <th>Concessionária</th>
                                    <th>Nome</th>
                                    <th>Matricula</th>
                                    <th>Estado</th>
                                    <th>Data</th>
                                    <th data-orderable="false"></th>
                                    @if(Auth::user()->admin == 1)
                                    <th data-orderable="false"></th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contracts as $contract)
                                <tr>
                                    <td>{{$contract->dealership->user->name}}</td>
                                    <td>{{$contract->vehicle->owner->full_name}}</td>
                                    <td>{{$contract->vehicle->license_plate}}</td>
                                    <td>{{$contract->status}}</td>
                                    <td>{{$contract->vehicle->created_at}}</td>
                                    <td class="text-end">
                                        <button type="button" onclick="downloadPdf({{$contract->id}})" class="waves-effect waves-light btn btn-primary mb-5">PDF</button>
                                    </td>
                                    @if(Auth::user()->admin == 1)
                                    <td class="text-end">
                                        <button type="button" onclick="edit({{$contract->id}})" class=" waves-effect waves-light btn btn-primary mb-5">Editar</button>
                                        @if($contract->status == 'activo')
                                        <button id="cancelBtn-{{$contract->id}}" type="button" onclick="cancel({{$contract->id}})" class=" waves-effect waves-light btn btn-primary mb-5">Anular</button>
                                        @endif
                                    </td>
                                    @endif
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
<script src="{{ asset('assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
<script src="{{ asset('assets/vendor_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

@if(Auth::user()->admin == 1)
<script>
    var isAdmin = true;
</script>
@else
<script>
    var isAdmin = false;
</script>
@endif
<script>
    $('#contracts').DataTable();
    $('.select2').select2({
        placeholder: "Selecione concessionária"
    });

    $('#dateRange').daterangepicker({
        opens: 'right',
        autoUpdateInput: false,
    });

    $('#dateRange').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });

    $('#dateRange').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    $('#filterData').on('click', function(e) {
        e.preventDefault();

        var dateRange = $('#dateRange').val();

        var selectedDealerships = $('#dealership').val();

        $('#contracts').DataTable().clear().destroy();

        filterData(dateRange, selectedDealerships);
    });

    var columns = [{
            data: 'dealership_name'
        },
        {
            data: 'owner_name'
        },
        {
            data: 'license_plate'
        },
        {
            data: 'status'
        },
        {
            data: 'created_at_formatted'
        },
        {
            data: 'pdf',
            orderable: false,
            searchable: false
        }
    ];

    if (isAdmin) {
        columns.push({
            data: 'actions',
            orderable: false,
            searchable: false
        });
    }

    function filterData(dateRange, selectedDealerships) {
        var data = {
            dateRange: dateRange,
            dealerships: selectedDealerships
        };

        $('#contracts').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/contracts/filter',
                type: 'GET',
                data: function(d) {
                    d.dateRange = $('#dateRange').val();
                    d.dealerships = $('#dealership').val();
                },
                dataSrc: function(json) {
                    return json.data;
                }
            },
            columns,
            drawCallback: function(settings) {
                $('#contracts tbody tr').each(function() {
                    var row = $(this);

                    row.find('td:nth-child(6)').addClass('text-end');
                    row.find('td:nth-child(7)').addClass('text-end');
                });
            }
        });
    }

    function downloadPdf(contractId) {
        var url = "{{ route('contractPdf', ':contractId') }}";
        url = url.replace(':contractId', contractId);

        window.open(url, '_blank');
    }

    function edit(contractId) {
        var url = "{{ route('contractEdit', ':contractId') }}";
        url = url.replace(':contractId', contractId);

        window.open(url);
    }

    function cancel(contractId) {

        var button = document.getElementById('cancelBtn-' + contractId);
        var row = button.closest('tr');
        var cells = row.getElementsByTagName('td');

        button.disabled = true;
        button.innerHTML = 'Cancelando...';


        var url = "{{ route('contractCancel', ':contractId') }}";
        url = url.replace(':contractId', contractId);

        window.open(url, '_blank');
        cells[3].textContent = 'anulado';

        button.remove();
    }
</script>
@endpush

@endsection
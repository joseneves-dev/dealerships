@extends('layouts.app')

@section('content')
<style>
    .select2-selection {
        padding-left: 5px;
        height: 40px !important;
        background-color: #ffffff !important;
    }
</style>
<section class="content">
    <form id="createContractForm" class="form">
        @csrf
        @if(Auth::user()->admin == 1)
        <div class="row">
            <div class="col-lg-6 col-6 mx-auto">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Identifcação do Concessionária</h4>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select name="dealership" id="dealership" class="form-control select2 @error('dealership') is-invalid @enderror" style="width: 100%;">
                                        <option value="">Selecione uma Concessionária</option>
                                        @foreach($dealerships as $dealership)
                                        <option value="{{ $dealership->id }}" @if( old('dealership')==$dealership->id) selected @endif >
                                            {{ $dealership->user->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('dealership')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Identifcação do Veículo</h4>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Marca</label>
                                    <input name="brand" id="brand" type="text" value="{{ old('brand') }}" required class="form-control  @error('brand') is-invalid @enderror">
                                    @error('brand')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Modelo</label>
                                    <input name="model" id="model" type="text" value="{{ old('model') }}" required class="form-control  @error('model') is-invalid @enderror">
                                    @error('model')
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
                                    <label class="form-label">Versão</label>
                                    <input name="version" id="version" type="text" value="{{ old('version') }}" required class="form-control  @error('version') is-invalid @enderror">
                                    @error('version')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">C. C.</label>
                                    <input name="cc" id="cc" type="text" value="{{ old('cc') }}" required class="form-control  @error('cc') is-invalid @enderror">
                                    @error('cc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Combustivel</label>
                                    <input name="fuel" id="fuel" type="text" value="{{ old('fuel') }}" required class="form-control  @error('fuel') is-invalid @enderror">
                                    @error('fuel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Data primeira matricula</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input name="first_date_license_plate" id="first_date_license_plate" type="text" value="{{ old('first_date_license_plate') }}" required class="form-control  pull-right @error('first_date_license_plate') is-invalid @enderror">

                                        @error('first_date_license_plate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Matrícula</label>
                                    <input name="license_plate" id="license_plate" type="text" value="{{ old('license_plate') }}" required class="form-control  @error('license_plate') is-invalid @enderror">
                                    @error('license_plate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Número chassi</label>
                                    <input name="chassi_number" id="chassi_number" type="text" value="{{ old('chassi_number') }}" required class="form-control  @error('chassi_number') is-invalid @enderror">
                                    @error('chassi_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Cor</label>
                                    <input name="color" id="color" type="text" value="{{ old('color') }}" required class="form-control  @error('color') is-invalid @enderror">
                                    @error('color')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Quilometragem</label>
                                    <input name="km" id="km" type="text" value="{{ old('km') }}" required class="form-control  @error('km') is-invalid @enderror">
                                    @error('km')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Ultima data de manutenção</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input name="last_inspection" id="last_inspection" type="text" value="{{ old('last_inspection') }}" required class="form-control pull-right @error('last_inspection') is-invalid @enderror">

                                        @error('last_inspection')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Km</label>
                                    <input name="last_inspection_km" id="last_inspection_km" type="text" value="{{ old('last_inspection_km') }}" required class="form-control  @error('last_inspection_km') is-invalid @enderror">
                                    @error('last_inspection_km')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-6 col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Identifcação Proprietário</h4>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label class="form-label">Nome Completo</label>
                                    <input name="full_name" id="full_name" type="text" value="{{ old('full_name') }}" required class="form-control  @error('full_name') is-invalid @enderror">
                                    @error('full_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Morada</label>
                                    <input name="address" id="address" type="text" value="{{ old('address') }}" required class="form-control  @error('address') is-invalid @enderror">
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="form-label">Localidade</label>
                                    <input name="locale" id="locale" type="text" value="{{ old('locale') }}" required class="form-control  @error('locale') is-invalid @enderror">
                                    @error('locale')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="form-label">Código postal</label>
                                    <input name="zip" id="zip" type="text" value="{{ old('zip') }}" required class="form-control  @error('zip') is-invalid @enderror">
                                    @error('zip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Telémovel</label>
                                    <input name="phone" id="phone" type="text" value="{{ old('phone') }}" required class="form-control  @error('phone') is-invalid @enderror">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">E-mail</label>
                                    <input name="email" id="email" type="email" value="{{ old('email') }}" required class="form-control  @error('email') is-invalid @enderror">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Notas</label>
                            <textarea name="obs" id="obs" rows="4" value="{{ old('obs') }}" class="form-control  @error('obs') is-invalid @enderror"></textarea>
                            @error('obs')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="box-footer text-end">
                        <a href="{{route('home')}}" class="btn btn-primary-light me-1">
                            <i class="ti-trash"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti-save-alt"></i> Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>

@push('scripts')
@if(Auth::user()->admin == 1)
<script src="{{ asset('assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
<script>
    $('.select2').select2({
        placeholder: "Selecione concessionária"
    });
</script>
@endif
<script src="{{ asset('assets/vendor_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // Handle form submission with AJAX
        $('#createContractForm').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission
            var csrfToken = $('#createContractForm input[name="_token"]').val();

            // Send the AJAX request to create the contract and generate the PDF
            $.ajax({
                url: 'new',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {

                    // Trigger the PDF download (start the download immediately)
                    // This is done by navigating to the PDF URL
                    window.location.href = response.contractId + '/pdf'; // Update with the correct PDF URL

                    // Redirect to the home page after a delay (optional)
                    setTimeout(function() {
                        window.location.href = response.redirect;
                    }, 2000); // Adjust the delay as needed
                },
                error: function(xhr) {
                    // Clear previous error messages
                    $('.invalid-feedback').remove(); // Remove any old error messages
                    $('.form-control').removeClass('is-invalid'); // Remove the invalid class from all inputs

                    // Check if there are validation errors
                    if (xhr.status === 422) { // 422 status means validation errors
                        var errors = xhr.responseJSON.errors;

                        // Iterate over each error and show the corresponding error message
                        $.each(errors, function(field, messages) {
                            // Find the input element with the matching name
                            var inputElement = $('[name="' + field + '"]');

                            // Add the 'is-invalid' class to the input element
                            inputElement.addClass('is-invalid');

                            // Create the error message HTML
                            var errorMessage = '<span class="invalid-feedback" role="alert"><strong>' + messages[0] + '</strong></span>';

                            // Append the error message below the input
                            inputElement.after(errorMessage);
                        });
                    }
                }
            });
        });
    });

    $('#first_date_license_plate').datepicker({
        autoclose: true
    });

    $('#last_inspection').datepicker({
        autoclose: true
    });
</script>
@endpush
@endsection
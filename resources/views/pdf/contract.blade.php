<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contract PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .dealership-info {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 12px;
            border: 1px solid #ddd;
            padding: 10px;
            background-color: #f4f4f4;
            width: 250px;
        }

        .dealership-info div {
            margin-bottom: 5px;
        }

        .content {
            display: flex;
            justify-content: space-between;
            margin-top: 100px;
        }

        .table-container {
            margin-top: 120px;
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .left-column,
        .right-column {
            width: 48%;
            padding: 10px;
            border: 1px solid #ddd;
            margin-right: 2%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        table th,
        table td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #f4f4f4;
        }

        .table-header {
            background-color: #f8f8f8;
            font-weight: bold;
            text-align: center;
        }

        .no-border {
            border: 0px !important;
        }

        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        .container {
            width: 100%;
        }

        .outer-table {
            border: none;
        }

        td {
            vertical-align: top;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="dealership-info">
            <div>{{ $contract->dealership->user->name ?? '' }}</div>
            <div>{{ $contract->dealership->nif ?? '' }}</div>
            <div>{{ $contract->dealership->address ?? '' }}</div>
            <div>{{ $contract->dealership->zip ?? '' }} {{ $contract->dealership->locale ?? '' }}</div>
        </div>

        <div class="table-container">
            <table class="outer-table">
                <tr>
                    <td class="no-border">
                        <h3>Identificação Veículo</h3>
                        <table>
                            <tr>
                                <th>Marca</th>
                                <td>{{ $contract->vehicle->brand }}</td>
                            </tr>
                            <tr>
                                <th>Modelo</th>
                                <td>{{ $contract->vehicle->model }}</td>
                            </tr>
                            <tr>
                                <th>Versão</th>
                                <td>{{ $contract->vehicle->version }}</td>
                            </tr>
                            <tr>
                                <th>C. C.</th>
                                <td>{{ $contract->vehicle->cc }} </td>
                            </tr>
                            <tr>
                                <th>Combustivel</th>
                                <td>{{ $contract->vehicle->fuel }} </td>
                            </tr>
                            <tr>
                                <th>Data primeira matricula</th>
                                <td>{{ $contract->vehicle->first_date_license_plate }}</td>
                            </tr>
                            <tr>
                                <th>Matricula</th>
                                <td>{{ $contract->vehicle->license_plate }}</td>
                            </tr>
                            <tr>
                                <th>Número chassi</th>
                                <td>{{ $contract->vehicle->chassi_number }}</td>
                            </tr>
                            <tr>
                                <th>Cor</th>
                                <td>{{ $contract->vehicle->color }}</td>
                            </tr>
                            <tr>
                                <th>Quilometragem</th>
                                <td>{{ $contract->vehicle->km }} KM</td>
                            </tr>
                            <tr>
                                <th>Ultima data de manutenção</th>
                                <td>{{ $contract->vehicle->last_inspection }} - KM {{ $contract->vehicle->last_inspection_km }}</td>
                            </tr>
                        </table>
                    </td>
                    <!-- Owner Information Table -->
                    <td class="no-border">
                        <h3>Identificação Proprietário</h3>
                        <table>
                            <tr>
                                <th>Nome Completo</th>
                                <td>{{ $contract->vehicle->owner->full_name }}</td>
                            </tr>
                            <tr>
                                <th>Morada</th>
                                <td>{{ $contract->vehicle->owner->address ?? 'Not Available' }}</td>
                            </tr>
                            <tr>
                                <th>Localidade - Código postal</th>
                                <td>{{ $contract->vehicle->owner->locale ?? 'Not Available' }} {{ $contract->vehicle->owner->zip ?? 'Not Available' }}</td>
                            </tr>
                            <tr>
                                <th>Telémovel</th>
                                <td>{{ $contract->vehicle->owner->phone ?? 'Not Available' }}</td>
                            </tr>
                            <tr>
                                <th>E-mail</th>
                                <td>{{ $contract->vehicle->owner->email ?? 'Not Available' }}</td>
                            <tr>
                                <th>Notas</th>
                                <td>{{ $contract->obs ?? '-' }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Contract Date and Status -->
        <div>
            <table>
                <tr>
                    <th>Data contrato</th>
                    <td>{{ $contract->created_at }}</td>
                </tr>
                <tr>
                    <th>Estado</th>
                    <td>{{ $contract->status }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="container">

        <!-- Dealership Info displayed at the top-right corner -->
        <div class="dealership-info">
            <div>{{ $contract->dealership->user->name ?? '' }}</div>
            <div>{{ $contract->dealership->nif ?? '' }}</div>
            <div>{{ $contract->dealership->address ?? '' }}</div>
            <div>{{ $contract->dealership->zip ?? '' }} {{ $contract->dealership->locale ?? '' }}</div>
        </div>

        <!-- Vehicle and Owner Information side by side in the same row -->
        <div class="table-container">
            <!-- Outer table without border -->
            <table class="outer-table">
                <tr>
                    <td class="no-border">
                        <h3>Identificação Veículo</h3>
                        <table>
                            <tr>
                                <th>Marca</th>
                                <td>{{ $contract->vehicle->brand }}</td>
                            </tr>
                            <tr>
                                <th>Modelo</th>
                                <td>{{ $contract->vehicle->model }}</td>
                            </tr>
                            <tr>
                                <th>Versão</th>
                                <td>{{ $contract->vehicle->version }}</td>
                            </tr>
                            <tr>
                                <th>C. C.</th>
                                <td>{{ $contract->vehicle->cc }} </td>
                            </tr>
                            <tr>
                                <th>Combustivel</th>
                                <td>{{ $contract->vehicle->fuel }} </td>
                            </tr>
                            <tr>
                                <th>Data primeira matricula</th>
                                <td>{{ $contract->vehicle->first_date_license_plate }}</td>
                            </tr>
                            <tr>
                                <th>Matricula</th>
                                <td>{{ $contract->vehicle->license_plate }}</td>
                            </tr>
                            <tr>
                                <th>Número chassi</th>
                                <td>{{ $contract->vehicle->chassi_number }}</td>
                            </tr>
                            <tr>
                                <th>Cor</th>
                                <td>{{ $contract->vehicle->color }}</td>
                            </tr>
                            <tr>
                                <th>Quilometragem</th>
                                <td>{{ $contract->vehicle->km }} KM</td>
                            </tr>
                            <tr>
                                <th>Ultima data de manutenção</th>
                                <td>{{ $contract->vehicle->last_inspection }} - KM {{ $contract->vehicle->last_inspection_km }}</td>
                            </tr>
                        </table>
                    </td>
                    <!-- Owner Information Table -->
                    <td class="no-border">
                        <h3>Identificação Proprietário</h3>
                        <table>
                            <tr>
                                <th>Nome Completo</th>
                                <td>{{ $contract->vehicle->owner->full_name }}</td>
                            </tr>
                            <tr>
                                <th>Morada</th>
                                <td>{{ $contract->vehicle->owner->address ?? 'Not Available' }}</td>
                            </tr>
                            <tr>
                                <th>Localidade - Código postal</th>
                                <td>{{ $contract->vehicle->owner->locale ?? 'Not Available' }} {{ $contract->vehicle->owner->zip ?? 'Not Available' }}</td>
                            </tr>
                            <tr>
                                <th>Telémovel</th>
                                <td>{{ $contract->vehicle->owner->phone ?? 'Not Available' }}</td>
                            </tr>
                            <tr>
                                <th>E-mail</th>
                                <td>{{ $contract->vehicle->owner->email ?? 'Not Available' }}</td>
                            <tr>
                                <th>Notas</th>
                                <td>{{ $contract->obs ?? 'Not Available' }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Contract Date and Status -->
        <div>
            <table>
                <tr>
                    <th>Data contrato</th>
                    <td>{{ $contract->created_at }}</td>
                </tr>
                <tr>
                    <th>Estado</th>
                    <td>{{ $contract->status }}</td>
                </tr>
            </table>
        </div>
    </div>

</body>

</html>
<?php

namespace App\Http\Helpers;

use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Contracts;

class GeneratePdf
{
    public static function generatePdf($contractId, $action = 'download')
    {
        $contract = Contracts::with('vehicle.owner', 'dealership.user')
            ->findOrFail($contractId);

        $pdf = PDF::loadView('pdf.contract', compact('contract'));

        switch ($action) {
            case 'view':
                return $pdf->stream();
            case 'download':
            default:
                return $pdf->download('contract_' . $contractId . '.pdf');
        }
    }
}

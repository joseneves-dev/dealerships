<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Helpers\GeneratePdf;

use App\Models\Contracts;
use App\Models\Vehicles;
use App\Models\VehiclesOwners;
use App\Models\Dealerships;

class ContractsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function filter(Request $request)
    {
        $query = Contracts::with('vehicle.owner', 'dealership.user');

        if ($request->has('dateRange')) {
            $dates = explode(' - ', $request->input('dateRange'));
            if (count($dates) == 2) {
                $startDate = Carbon::createFromFormat('m/d/Y', trim($dates[0]))->startOfDay();
                $endDate = Carbon::createFromFormat('m/d/Y', trim($dates[1]))->endOfDay();
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }
        }

        if (Auth::user()->admin == 1) {
            if ($request->has('dealerships')) {
                $dealershipIds = $request->input('dealerships');
                $query->whereIn('dealership_id', $dealershipIds);
            }
            $contracts = $query->get();


            return DataTables::of($contracts)
                ->addColumn('pdf', function ($contract) {
                    return '<button type="button"  onclick="downloadPdf(' . $contract->id . ')" class="waves-effect waves-light btn btn-primary mb-5">PDF</button>';
                })
                ->addColumn('actions', function ($contract) {
                    if ($contract->status == 'activo') {
                        $editButton = '<button type="button" onclick="edit(' . $contract->id . ')" class="waves-effect waves-light btn btn-primary mb-5" data-id="' . $contract->id . '">Editar</button>';
                        $cancelButton = '<button id="cancelBtn-' . $contract->id . '" type="button" onclick="cancel(' . $contract->id . ')" class="waves-effect waves-light btn btn-primary mb-5" data-id="' . $contract->id . '">Anular</button>';

                        return $editButton . ' ' . $cancelButton;
                    } else {
                        return  '<button type="button" onclick="edit(' . $contract->id . ')" class="waves-effect waves-light btn btn-primary mb-5" data-id="' . $contract->id . '">Editar</button>';
                    }
                })
                ->addColumn('dealership_name', function ($contract) {
                    return $contract->dealership->user->name;
                })
                ->addColumn('owner_name', function ($contract) {
                    return $contract->vehicle->owner->full_name;
                })
                ->addColumn('license_plate', function ($contract) {
                    return $contract->vehicle->license_plate;
                })
                ->addColumn('status', function ($contract) {
                    return $contract->status;
                })
                ->addColumn('created_at_formatted', function ($contract) {
                    return $contract->created_at->format('d/m/Y H:i:s');
                })
                ->rawColumns(['pdf', 'actions'])
                ->make(true);
        } else {
            $query->whereHas('dealership.user', function ($query) {
                $query->where('id', Auth::user()->id);
            });

            $contracts = $query->get();


            return DataTables::of($contracts)
                ->addColumn('pdf', function ($contract) {
                    return '<button type="button"  onclick="downloadPdf(' . $contract->id . ')" class="waves-effect waves-light btn btn-primary mb-5">PDF</button>';
                })
                ->addColumn('dealership_name', function ($contract) {
                    return $contract->dealership->user->name;
                })
                ->addColumn('owner_name', function ($contract) {
                    return $contract->vehicle->owner->full_name;
                })
                ->addColumn('license_plate', function ($contract) {
                    return $contract->vehicle->license_plate;
                })
                ->addColumn('status', function ($contract) {
                    return $contract->status;
                })
                ->addColumn('created_at_formatted', function ($contract) {
                    return $contract->created_at->format('d/m/Y H:i:s');
                })
                ->rawColumns(['pdf'])
                ->make(true);
        }
    }

    public function generatePdf($contractId)
    {
        return GeneratePdf::generatePdf($contractId, 'download');
    }

    public function showNewForm()
    {
        $dealerships = [];
        if (Auth::user()->admin == 1) {
            $dealerships = Dealerships::with('user')->get();
        }

        return view('contracts.new', ['dealerships' => $dealerships]);
    }

    public function new(Request $request)
    {

        if (Auth::user()->admin == 1) {
            $validatedDealership = $request->validate([
                'dealership' => 'required',
            ]);
            $dealershipId = $validatedDealership['dealership'];
        } else {
            $dealershipId = Dealerships::whereHas('user', function ($query) {
                $query->where('id', Auth::user()->id);
            })
                ->pluck('id')
                ->first();
        }

        $validatedData = $request->validate([
            'brand' => 'required|string',
            'model' => 'required|string',
            'version' => 'required|string',
            'cc' => 'required|string',
            'fuel' => 'required|string',
            'first_date_license_plate' => 'required|string',
            'license_plate' => 'required|string',
            'chassi_number' => 'required|string',
            'color' => 'required|string',
            'km' => 'required|string',
            'last_inspection' => 'nullable|string',
            'last_inspection_km' => 'nullable|string',
            'full_name' => 'required|string',
            'address' => 'required|string',
            'locale' => 'required|string',
            'zip' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
            'obs' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            $vehiclesOwner = VehiclesOwners::create([
                'full_name' => $validatedData['full_name'],
                'address' => $validatedData['address'],
                'locale' => $validatedData['locale'],
                'zip' => $validatedData['zip'],
                'phone' => $validatedData['phone'],
                'email' => $validatedData['email'],
            ]);


            $vehicle = Vehicles::create([
                'owner_id' => $vehiclesOwner->id,
                'brand' => $validatedData['brand'],
                'model' => $validatedData['model'],
                'version' => $validatedData['version'],
                'cc' => $validatedData['cc'],
                'fuel' => $validatedData['fuel'],
                'first_date_license_plate' => $validatedData['first_date_license_plate'],
                'license_plate' => $validatedData['license_plate'],
                'chassi_number' => $validatedData['chassi_number'],
                'color' => $validatedData['color'],
                'km' => $validatedData['km'],
                'last_inspection' => $validatedData['last_inspection'],
                'last_inspection_km' => $validatedData['last_inspection_km'],
            ]);


            $contract = Contracts::create([
                'dealership_id' => $dealershipId,
                'vehicle_id' => $vehicle->id,
                'obs' => $validatedData['obs'] ?? null,
                'status' => 'activo',
            ]);

            DB::commit();

            return response()->json([
                'contractId' => $contract->id,
                'redirect' => route('home')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'An error occurred while creating the contract.');
        }
    }

    public function showEditForm(Request $request)
    {
        $dealerships = [];
        if (Auth::user()->admin == 1) {
            $dealerships = Dealerships::with('user')->get();
        }

        $data = Contracts::with('vehicle.owner')->where('id', $request->id)->first();
        return view('contracts.edit', ['data' => $data, 'dealerships' => $dealerships]);
    }

    public function edit(Request $request)
    {
        $contract = Contracts::with('vehicle.owner')->findOrFail($request->id);

        $vehicle = $contract->vehicle;
        $vehiclesOwner = $vehicle->owner;

        $validatedDealership = Auth::user()->admin == 1
            ? $request->validate(['dealership' => 'required'])
            : ['dealership' => $contract->dealership_id];

        $validatedData = $request->validate([
            'brand' => 'required|string',
            'model' => 'required|string',
            'version' => 'required|string',
            'cc' => 'required|string',
            'fuel' => 'required|string',
            'first_date_license_plate' => 'required|string',
            'license_plate' => 'required|string',
            'chassi_number' => 'required|string',
            'color' => 'required|string',
            'km' => 'required|string',
            'last_inspection' => 'nullable|string',
            'last_inspection_km' => 'nullable|string',
            'full_name' => 'required|string',
            'address' => 'required|string',
            'locale' => 'required|string',
            'zip' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
            'obs' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            $vehiclesOwner->update([
                'full_name' => $validatedData['full_name'],
                'address' => $validatedData['address'],
                'locale' => $validatedData['locale'],
                'zip' => $validatedData['zip'],
                'phone' => $validatedData['phone'],
                'email' => $validatedData['email'],
            ]);

            $vehicle->update([
                'brand' => $validatedData['brand'],
                'model' => $validatedData['model'],
                'version' => $validatedData['version'],
                'cc' => $validatedData['cc'],
                'fuel' => $validatedData['fuel'],
                'first_date_license_plate' => $validatedData['first_date_license_plate'],
                'license_plate' => $validatedData['license_plate'],
                'chassi_number' => $validatedData['chassi_number'],
                'color' => $validatedData['color'],
                'km' => $validatedData['km'],
                'last_inspection' => $validatedData['last_inspection'],
                'last_inspection_km' => $validatedData['last_inspection_km'],
            ]);

            $contract->update([
                'dealership_id' => $validatedDealership['dealership'],
                'obs' => $validatedData['obs'] ?? $contract->obs,
                'status' => 'activo',
            ]);

            DB::commit();

            return response()->json([
                'contractId' => $contract->id,
                'redirect' => route('home')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'An error occurred while updating the contract.',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function cancel(Request $request)
    {
        $contract = Contracts::with('vehicle.owner')->findOrFail($request->id);

        $contract->update([
            'status' => 'anulado'
        ]);

        $contract->save();

        return GeneratePdf::generatePdf($request->id, 'download');
    }
}

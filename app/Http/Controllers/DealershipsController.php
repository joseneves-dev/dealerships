<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Models\Dealerships;
use App\Models\User;

class DealershipsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view()
    {
        $dealerships = Dealerships::with('user')->get();

        return view('dealerships.view', ['dealerships' => $dealerships]);
    }

    public function showNewForm()
    {
        return view('dealerships.new');
    }

    public function new(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'tax_number' => 'required|string|max:9|min:9',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'locale' => 'required|string',
            'zip' => 'required|string|max:8',
        ]);

        DB::beginTransaction();

        try {
            $dealership = Dealerships::create([
                'tax_number' => $validatedData['tax_number'],
                'phone' => $validatedData['phone'],
                'address' => $validatedData['address'],
                'locale' => $validatedData['locale'],
                'zip' => $validatedData['zip'],
            ]);

            $user = User::create([
                'dealership_id' => $dealership->id,
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'admin' => false,
            ]);

            DB::commit();

            return redirect()->route('viewDealerships')->with('success', 'Dealership and User created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'There was an error creating the dealership and user.');
        }
    }

    public function showEditForm(Request $request)
    {
        $data = Dealerships::with('user')->where('id', $request->id)->first();
        return view('dealerships.edit', ['data' => $data]);
    }

    public function edit(Request $request)
    {
        $dealership = Dealerships::with('user')->findOrFail($request->id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'tax_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'locale' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'nullable|string|min:8',
        ]);

        $dealership->tax_number = $validatedData['tax_number'];
        $dealership->address = $validatedData['address'];
        $dealership->locale = $validatedData['locale'];
        $dealership->zip = $validatedData['zip'];
        $dealership->phone = $validatedData['phone'];
        $dealership->save();

        $user = $dealership->user;

        $user->name = $validatedData['name'];

        $user->email = $validatedData['email'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        $dealerships = Dealerships::with('user')->get();

        return view('dealerships.view', ['dealerships' => $dealerships]);
    }
}

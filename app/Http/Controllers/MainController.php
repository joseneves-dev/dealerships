<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Models\Contracts;
use App\Models\Dealerships;
use App\Models\User;

class MainController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        $contracts = [];
        $dealerships = [];
        if (Auth::user()->admin == 1) {
            $contracts = Contracts::with('vehicle.owner')->get();
            $dealerships = Dealerships::with('user')->get();
        } else {
            $contracts = Contracts::with('vehicle.owner', 'dealership.user')->whereHas('dealership.user', function ($query) {
                $query->where('id', Auth::user()->id);
            })->get();
        }

        return view('home', ['contracts' => $contracts, 'dealerships' => $dealerships]);
    }

    public function info()
    {
        $data = User::with('dealership')->find(Auth::user()->id);

        return view('info', ['data' => $data]);
    }
}

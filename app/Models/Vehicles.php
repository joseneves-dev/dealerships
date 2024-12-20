<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\VehiclesOwners;


class Vehicles extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'brand',
        'model',
        'version',
        'cc',
        'fuel',
        'first_date_license_plate',
        'license_plate',
        'chassi_number',
        'color',
        'km',
        'last_inspection',
        'last_inspection_km'
    ];

    public function owner()
    {
        return $this->HasOne(VehiclesOwners::class, 'id', 'owner_id');
    }
}

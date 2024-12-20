<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiclesOwners extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'address',
        'locale',
        'zip',
        'phone',
        'email',
        'obs'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicles::class, 'vehicle_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contracts extends Model
{
    use HasFactory;

    protected $fillable = [
        'dealership_id',
        'vehicle_id',
        'obs',
        'status'
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function dealership()
    {
        return $this->hasOne(Dealerships::class, 'id', 'dealership_id');
    }

    public function vehicle()
    {
        return $this->hasOne(Vehicles::class, 'id', 'vehicle_id');
    }
}

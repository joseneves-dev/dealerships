<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealerships extends Model
{
    use HasFactory;

    protected $fillable = [
        'tax_number',
        'phone',
        'phone',
        'address',
        'locale',
        'zip'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'dealership_id');
    }
}

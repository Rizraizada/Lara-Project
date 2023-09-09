<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehicledriver extends Model
{
    use HasFactory;

    protected $table = 'vehicledrivers';
    protected $fillable=['id','vehicle_id','vehicle_driver_id','duration_from','duration_to'];
}

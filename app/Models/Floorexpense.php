<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floorexpense extends Model
{
    use HasFactory;

    protected $table = 'floorexpenses';
    protected $fillable = ['id', 'floor_id','item_id','expense_quantity','expense_price'];
}

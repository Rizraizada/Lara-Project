<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FloorSettle extends Model
{
    use HasFactory;

    protected $table = 'floor_settles';
    protected $fillable = ['id', 'floor_id','item_id','quantity','remain_qunatity','total_price'];
}

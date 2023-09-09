<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userrole extends Model
{
    use HasFactory;

    protected $table = 'userroles';
    protected $fillable = ['id', 'role_name'];
}

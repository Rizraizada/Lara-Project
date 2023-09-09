<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $table = 'templates';
    protected $fillable = ['id', 'template_name','template_details'];
}

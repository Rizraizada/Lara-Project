<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queri extends Model
{
    use HasFactory;

    protected $table = 'queries';
    protected $fillable = ['id', 'note_id','send_from', 'send_to','query_question','query_answer'];
}

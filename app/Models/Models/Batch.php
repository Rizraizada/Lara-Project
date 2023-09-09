<?php

namespace App\Models\Models;

use App\Models\Intake;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $table = 'batches';
    protected $fillable = ['name','year','intake_id','file_no','created_by'];


    public function intake()
    {
        return $this->belongsTo(Intake::class);
    }
}

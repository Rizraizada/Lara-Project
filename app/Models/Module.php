<?php

namespace App\Models;

use App\Models\Models\Batch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Module extends Model
{
    use HasFactory;
    public function batch()
    {
        return $this->BelongsTo(Batch::class);
    }

    public function subjects()
    {
        return $this->hasMany(ModuleWiseCourse::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','specialization','hospitals_id'
    ];

    public function hospital():BelongsTo{return $this->belongsTo(Hospital::class,'hospitals_id');}
}
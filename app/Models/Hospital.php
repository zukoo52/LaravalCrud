<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hospital extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','address','phone'
    ];


   public function doctor():HasMany{return $this->hasMany(Doctor::class,'Doctor_id');}
   // 
    //public function course():HasMany{return $this->hasMany(Course::class,'Branch_id');}
   // $table->id();
   // $table->string('name');
   //  $table->string('address');
   //  $table->string('phone');

}

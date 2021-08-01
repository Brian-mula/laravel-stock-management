<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable=[
        'username',
        'first_name',
        'last_name',
        'country_id',
        'city_id',
        'address',
        'salary'
    ];

    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }
    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }
}

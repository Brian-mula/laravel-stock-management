<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable=[
        'first_name',
        'last_name',
        'contact',
        'country_id',
        'city_id'
    ];
    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }
    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }
}

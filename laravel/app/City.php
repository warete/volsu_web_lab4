<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    public $timestamps = false;

    protected $fillable = ['name'];

    public function shops()
    {
        return $this->hasMany('App\Shop', 'city_id');
    }
}

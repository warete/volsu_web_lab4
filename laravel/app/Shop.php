<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shops';
    public $timestamps = false;

    protected $fillable = ['longitude', 'latitude', 'address', 'city_id'];

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function requests()
    {
        return $this->hasMany('App\Request', 'shop_id');
    }
}

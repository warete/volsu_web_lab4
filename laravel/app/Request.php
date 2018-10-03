<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table = 'requests';
    public $timestamps = false;

    protected $fillable = ['name', 'description', 'status', 'shop_id', 'user_id'];

    public function shop()
    {
        return $this->belongsTo('App\Shop');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

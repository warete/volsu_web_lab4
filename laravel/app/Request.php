<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table = 'requests';
    public $timestamps = false;
    public static $statuses = [
        1 => [
            'name' => 'Новая',
            'class' => 'new'
        ],
        2 => [
            'name' => 'Выполняется',
            'class' => 'waiting'
        ],
        3 => [
            'name' => 'Завершена',
            'class' => 'done'
        ]
    ];

    protected $fillable = ['name', 'description', 'status', 'shop_id', 'user_id'];

    public function shop()
    {
        return $this->belongsTo('App\Shop');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function responds()
    {
        return $this->hasMany('App\Respond', 'request_id');
    }
}

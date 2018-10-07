<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respond extends Model
{
    protected $table = 'responds';
    public $timestamps = false;
    public static $statuses = [
        1 => [
            'name' => 'Завершен',
            'class' => 'accepted'
        ],
        2 => [
            'name' => 'Выполняется',
            'class' => 'performed'
        ],
        3 => [
            'name' => 'Отклонен',
            'class' => 'rejected'
        ],
        4 => [
            'name' => 'Ожидает',
            'class' => 'waiting'
        ]
    ];

    protected $fillable = ['status', 'request_id', 'user_id', 'comment'];

    public function request()
    {
        return $this->belongsTo('App\Request');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

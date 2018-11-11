<?php

namespace Heroes\Usuario\Model;

use Illuminate\Notifications\Notifiable;
use DesignMyNight\Mongodb\Auth\User as MongoAuth;
use Laravel\Passport\HasApiTokens;

class Usuario extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $collection = 'usuarios';
    protected $connection = 'mongodb';
    protected $table = 'usuarios';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}

<?php

namespace Heroes\Usuario\Model;

use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use DesignMyNight\Mongodb\Auth\User as MongoAuth;

class Usuario extends MongoAuth
{
    use HasApiTokens, SoftDeletes, Notifiable;

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

<?php

namespace Heroes\FavoritarPersonagens\Model;

use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    protected $collection = 'usuarios';
    protected $connection = 'mongodb';
    protected $table = 'favoritos';

    protected $primaryKey = '_id';
    protected $guarded = ['_id'];
}

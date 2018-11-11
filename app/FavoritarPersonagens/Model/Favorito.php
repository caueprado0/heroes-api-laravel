<?php

namespace Heroes\FavoritarPersonagens\Model;

use Jenssegers\Mongodb\Eloquent\Model;

class Favorito extends Model
{
    protected $collection = 'favoritos';
    protected $connection = 'mongodb';
    protected $table = 'favoritos';

    protected $primaryKey = '_id';
    protected $guarded = ['_id'];
}

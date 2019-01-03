<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planet extends Model
{
    protected $fillable = ['nome', 'clima', 'terreno', 'filmes'];

    protected $dates = ['deleted_at'];

    public function planets()
    {
        return $this->hasMany('App\Planet');
    }
}

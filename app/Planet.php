<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Planet extends Model
{
    protected $fillable = ['nome', 'clima', 'terreno', 'filmes'];

    protected $dates = ['deleted_at'];

    public function planets()
    {
        return $this->hasMany('App\Planet');
    }
}

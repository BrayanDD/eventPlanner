<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    const pendiente = 1;
    const aceptado = 2;
    const rechazado = 3;
    protected $fillable = [
        'name',


    ];
    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }
}

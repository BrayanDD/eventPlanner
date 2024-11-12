<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    const PENDING = 1;
    const ACCEPTED = 2;
    const REJECTED = 3;
    protected $fillable = [
        'name',
       

    ];
    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }
}

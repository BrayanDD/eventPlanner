<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }
}

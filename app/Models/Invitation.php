<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    public function events()
    {
        return $this->belongsTo(Event::class); 
    }
    public function states()
    {
        return $this->belongsTo(State::class); 
    }
}

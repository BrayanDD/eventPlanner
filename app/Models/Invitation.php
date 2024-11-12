<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'state_id',
        'event_id',
        'user_id',

    ];
    public function event()
    {
        return $this->belongsTo(Event::class); 
    }
    public function state()
    {
        return $this->belongsTo(State::class); 
    }
    public function user()
    {
        return $this->belongsTo(User::class); 
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'date',
        'location',
        'price'

    ];

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }
    
    public function guests()
    {
        return $this->hasManyThrough(User::class, Invitation::class, 'event_id', 'id', 'id', 'user_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

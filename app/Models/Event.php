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

    public function guests()
    {
        return $this->belongsToMany(User::class, 'event_user');
    }


    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

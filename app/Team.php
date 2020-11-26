<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['owner_id', 'name', 'description'];

    public function path()
    {
    	return "/api/teams/{$this->id}";
    }

    public function owner()
    {
    	return $this->belongsTo(User::class, 'owner_id');
    }

    public function members()
    {
    	return $this->belongsToMany(User::class, 'team_members', 'team_id', 'user_id');
    }
}

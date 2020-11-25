<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['owner_id', 'name', 'description'];

    public function path()
    {
    	return "/teams/{$this->id}";
    }

    public function owner()
    {
    	return $this->belongsTo(User::class, 'owner_id');
    }
}

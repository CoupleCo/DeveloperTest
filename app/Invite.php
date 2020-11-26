<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $fillable = [
		'email', 'token', 'accepted', 'team_id',
	];

	protected $hidden = ['token'];
}

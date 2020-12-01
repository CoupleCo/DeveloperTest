<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Entity;

class Invite extends Entity
{
    protected $fillable = [
		'email', 'token', 'accepted', 'team_id',
	];

	protected $hidden = ['token'];

	public function validationRules()
	{
		return [
            'email' => 'required|email|exists:users',
            'team_id' => 'required|exists:teams,id',
            'token' => 'required',
        ];
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'email');
	}
}

<?php

namespace App\Repositories;

use \Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Invite;
use App\Team;

class InviteRepository {

	public function createInvite($data)
	{
		$user = User::whereEmail($data['email'])->firstOrFail();
		if ($user->team || $user->teams->count() > 0)
			throw new Exception("User is already a member of a team");

		$existingInvite = Invite::whereEmail($data['email'])->whereTeamId($data['team_id'])->first();

		if ($existingInvite) {
			$message = $existingInvite->accepted ? "Member already exists!" : "Invite already exists!";
			throw new Exception($message);
		}

		$data['token'] = Str::random(40);
		$invite = new Invite($data);

		if ($invite->save()) {
			$this->sendInviteMail($invite);
			return $invite;
		}

		return false;
	}

	public function acceptInvite($token)
	{
		$invite = Invite::whereToken($token)->firstOrFail();

		if ($invite->accepted)
			throw new Exception("Member already exists!");

		$invite->accepted = true;
		if (!$invite->save())
			return false;

		$team = Team::whereId($invite->team_id)->firstOrFail();
		$user = User::whereEmail($invite->email)->firstOrFail();

		$team->members()->save($user);

		return $team;
	}

	public function sendInviteMail($invite)
	{
		$mailBody = 'You\'ve been invited to join a team on DevTest: ' . url('/app#/invites', [$invite->token]);

		Mail::raw($mailBody, function ($message) use ($invite) {
			$message->to($invite->email);
			$message->from(request()->user()->email);
			$message->subject('Join Team');
		});
	}
}
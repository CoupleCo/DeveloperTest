<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invite;
use App\User;
use App\Team;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InviteController extends Controller
{
	public function store(Request $request)
	{
		request()->validate([
            'email' => 'required|email|exists:users',
            'team_id' => 'required|exists:teams,id',
        ]);

		$invite = Invite::whereEmail($request->email)->whereTeamId($request->team_id)->first();

		if (!is_null($invite)) {
			if ($invite->accepted) {
				return response()->json(['message' => 'User is already a member'], 422);
			} else {
				return response()->json(['message' => 'An invite has been sent to user already'], 422);
			}
		}

		$invite = Invite::create([
			'email' => $request->email,
			'token' => Str::random(40),
			'team_id' => $request->team_id,
		]);

		$mailBody = 'You\'ve been invited to join a team on DevTest: ' . url('invites', [$invite->token]);

		Mail::raw($mailBody, function ($message) use ($invite) {
			$message->to($invite->email);
			$message->from(request()->user()->email);
			$message->subject('Join Team');
		});

		return response()->json(compact('invite'), 200);
	}

	public function accept($token)
	{
		$invite = Invite::where('token', $token)->firstOrFail();

		if ($invite->accepted) {
			return response()->json(['message' => 'User already accepted the invitation'], 422);
		}

		$invite->accepted = true;

		$team = Team::whereId($invite->team_id)->firstOrFail();
		$user = User::whereEmail($invite->email)->firstOrFail();

		$team->members()->save($user);

		$invite->save();

		return response()->json(compact('team'), 200);
	}
}
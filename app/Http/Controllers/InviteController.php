<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\InviteRepository;
use \Exception;

class InviteController extends Controller
{
	protected $inviteRepo;

	public function __construct(InviteRepository $inviteRepo)
	{
		$this->inviteRepo = $inviteRepo;
	}

	public function store(Request $request)
	{
		try {

			$data = $request->all();
			if ($invite = $this->inviteRepo->createInvite($data))
				return response()->json(compact('invite'), 200);

			return response()->json(['message' => "Validation Error! Unable to send Invite."], 422);

		} catch (Exception $e) {
			return response()->json(['message' => $e->getMessage()], 400);
		}
	}

	public function accept($token)
	{
		try {

			if ($team = $this->inviteRepo->acceptInvite($token)) {
				return response()->json(compact('team'), 200);
			}

			return response()->json(['message' => "Validation Error! Unable to accept Invite."], 422);

		} catch (Exception $e) {
			return response()->json(['message' => $e->getMessage()], 400);
		}
	}

}
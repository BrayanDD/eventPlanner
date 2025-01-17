<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\State;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function index()
    {

        $invitations = Invitation::where('user_id',auth()->id())->where('state_id',State::pendiente)->with('user', 'event')->paginate(20);



        return view('invitations.index', compact('invitations'));
    }
    public function store(Request $request)
    {

       $this->authorize('create',Invitation::class);

        $request->validate([
            'user_ids' => 'required|array',
            'user_id.*' => 'exists:users,id',
            'event_id' => 'required|exists:events,id',
        ]);

        $event_id = $request->event_id;

        foreach ($request->user_ids as $user_id) {

            $existingInvitation = Invitation::where('user_id', $user_id)
                                            ->where('event_id', $event_id)
                                            ->first();

            if (!$existingInvitation) {

                Invitation::create([
                    'user_id' => $user_id,
                    'event_id' => $event_id,
                    'state_id' => 1,
                ]);
            }
        }

        return back()->with(['success' => true, 'message' => 'Invitaciones enviadas correctamente.']);
    }

    public function update(Request $request, Invitation $invitation)
    {
        $this->authorize('update',$invitation);

        $request->validate([
            'state_id' => 'required',
        ]);


        $invitation->update([
            'state_id' => $request->state_id,

        ]);

        return redirect()->route('invitations.index');
    }

}

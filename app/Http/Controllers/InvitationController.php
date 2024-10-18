<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id',
        ]);
    
        // Verificar si el usuario ya ha sido invitado
        $existingInvitation = Invitation::where('user_id', $request->user_id)
                                         ->where('event_id', $request->event_id)
                                         ->first();
    
        if ($existingInvitation) {
            return response()->json(['success' => false, 'message' => 'El usuario ya ha sido invitado.']);
        }
    
        // Crear la invitación
        Invitation::create([
            'user_id' => $request->user_id,
            'event_id' => $request->event_id,
            'state_id' => 1, 
        ]);
    
        return response()->json(['success' => true]);
    }
    
}

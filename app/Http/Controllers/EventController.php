<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Policies\EventPolicy;
use Illuminate\Http\Request;

class EventController extends Controller
{

    public function index()
    {

        $events = Event::where('user_id', auth()->id())->paginate(15);

        return view('events.index', compact('events'));
    }



    public function create()
    {
        $this->authorize('create', Event::class);
        return view('events.create');
    }


    public function store(Request $request)
    {
        $this->authorize('create', Event::class);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string',
            'price' => 'required|numeric',
        ]);


        Event::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
            'location' => $request->location,
            'price' => $request->price
        ]);

        return redirect()->route('home')->with('success', 'Evento creado con éxito.');
    }


    public function show(Event $event)
    {
        $this->authorize('view', $event);
       
       // listar a los usuarios disponibles para invitar
        $users = User::where('rol', 'asistente')->whereDoesntHave('invitations', function ($query) use ($event) {
            $query->where('event_id', $event->id);
        })->paginate(20);
        
        $invitations = $event->invitations()->with('user', 'state')->paginate(20);
        $totalCount = $invitations->count();
    
        
        $acceptedCount = $event->invitations()->whereHas('state', function($query) {
            $query->where('name', 'aceptado');
        })->count();
    
        
        $pendingCount = $event->invitations()->whereHas('state', function($query) {
            $query->where('name', 'pendiente');
        })->count();
    
        return view('events.show', compact('event', 'invitations', 'acceptedCount', 'pendingCount', 'totalCount','users'));
    }
    


    public function edit(Event $event)
    {
        $this->authorize('create', $event);
        
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        // Validar los datos de entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        // Actualizar el evento con los datos validados
        $event->update([
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
            'location' => $request->location,
            'price' => $request->price,
        ]);
        return redirect()->route('events.show',$request->id);
    }


    public function destroy(Event $event)
    {
        $this->authorize('create', $event);

        $event->delete();
        return redirect()->route('events.index')->with('success', 'Evento eliminado con éxito.');
    }
}

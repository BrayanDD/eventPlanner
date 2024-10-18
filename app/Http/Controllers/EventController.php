<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
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
        return view('events.create');
    }


    public function store(Request $request)
    {

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
       
        $guests = $event->guests;
    
        $users = User::where('rol', 'asistente')->whereDoesntHave('invitations', function ($query) use ($event) {
            $query->where('event_id', $event->id);
        })
        ->paginate(20);
        $totalCount = $guests->count();
    
    
        $acceptedCount = $event->invitations()->whereHas('state', function($query) {
            $query->where('name', 'aceptado');
        })->count();
    
        
        $pendingCount = $event->invitations()->whereHas('state', function($query) {
            $query->where('name', 'pendiente');
        })->count();
    
        return view('events.show', compact('event', 'guests', 'acceptedCount', 'pendingCount', 'totalCount','users'));
    }
    


    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
        ]);


        $event->update([
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
        ]);

        return redirect()->route('events.index')->with('success', 'Evento actualizado con éxito.');
    }


    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Evento eliminado con éxito.');
    }
}

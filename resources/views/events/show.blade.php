@extends('layouts.app')

@section('content')
  <div class="event-details">
    <h3 class="card-title">{{ $event->name }}</h3>
    
    <h6 class="card-subtitle mb-2 text-body-secondary">{{ $event->price }}</h6>
    <p class="card-text truncate">{{ $event->description }}</p>

    <p>Invitaciones aceptadas {{ $acceptedCount }} de {{ $totalCount }} </p>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Invitar</button>
    <h2>Invitados:</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Nombre del Invitado</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($guests as $guest)
          <tr>
            <td>{{ $guest->name }}</td>
            <td>
              @php
                $invitation = $event->invitations()->where('user_id', $guest->id)->first();
              @endphp
              @if ($invitation)
                @if ($invitation->state === 'aceptado')
                  <i class="bi bi-check-circle-fill text-success"></i> 
                @elseif ($invitation->state === 'pendiente')
                  <i class="bi bi-clock text-warning"></i>
                @elseif ($invitation->state === 'cancelado')
                  <i class="bi bi-x-circle-fill text-danger"></i> 
                @endif
              @else
                No invitado
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Usuarios</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table>
            <tr>
                <th>Nombre</th>
                <th>Invitar</th>
                
            </tr>
            @foreach ($users as $user )
            <tr id="user-row-{{ $user->id }}">
                <td>{{ $user->name }}</td>
                <td>
                    
                  <button class="btn btn-outline-secondary invite-button" data-user-id="{{ $user->id }}">Invitar</button>
                </td>
            </tr>
            @endforeach
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@endsection

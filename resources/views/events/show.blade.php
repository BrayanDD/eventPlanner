@extends('layouts.app')

@section('content')
  @php
    $user = auth()->user();
  @endphp
  <div class="event-details">
    <div class="container-event">
      <div class="d-flex mb-4">
        <div class="container-info ps-3">
          <h1 class="title-event">{{ $event->name }}</h1>

          <h6 class="card-subtitle mb-2 text-body-secondary">{{ $event->price }}
          </h6>
          <p class="card-text truncate">{{ $event->description }}</p>
        </div>
        <div class="container-soli ">

          <p class="d-flex"><img class="me-2" src="{{ asset('img/check.png') }}"
              style="width: 24px; height: 24px;">Invitaciones aceptadas
            {{ $acceptedCount }}</p>
          <p class="d-flex"><img class="me-2" src="{{ asset('img/wrong.png') }}"
              style="width: 24px; height: 24px;">Invitaciones rechazadas
            {{ $rejectedCount }}</p>
          <p class="d-flex"><img class="me-2"
              src="{{ asset('img/wall-clock.png') }}"
              style="width: 24px; height: 24px;">Invitaciones Pendientes
            {{ $pendingCount }}</p>
          <p>Total: {{ $totalCount}}</p>
        </div>
      </div>


      @auth

        @if ($user->rol === 'admin' || $user->rol === $event->user_id)
          <button class="btn btn-primary" data-bs-toggle="modal"
            data-bs-target="#exampleModal">Invitar</button>


          <a class="ms-3 " href="{{ route('events.edit', $event->id) }}">
            <button class="btn btn-primary">editar</button>
          </a>



          <div class="container">
            <h2>Invitados:</h2>
            <table class="table">
              <thead>
                <tr>
                  <th>Nombre del Invitado</th>
                  <th>Estado</th>

                </tr>
              </thead>
              <tbody>
                @foreach ($invitations as $invitation)
                  <tr>
                    <td>{{ $invitation->user->name }}</td>
                    <td>

                      @if ($invitation->state->name === 'aceptado')
                        <i class="bi bi-check-circle-fill text-success">dd</i>
                      @elseif ($invitation->state->name === 'pendiente')
                        <i class="bi bi-clock text-warning">ss</i>
                      @elseif ($invitation->state->name === 'cancelado')
                        <i class="bi bi-x-circle-fill text-danger"></i>
                      @else
                        No invitado
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            {{ $invitations->links() }}
          </div>
        @endauth
      @endif
    </div>

  </div>





  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Usuarios</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="inviteForm" action="{{ route('invitations.store') }}"
            method="POST">
            @csrf
            <input type="hidden" value="{{ $event->id }}" name="event_id">
            <table>
              <tr>
                <th>Seleccionar</th>
                <th>Nombre</th>
              </tr>
              @foreach ($users as $user)
                <tr id="user-row-{{ $user->id }}">
                  <td>
                    <input type="checkbox" name="user_ids[]"
                      value="{{ $user->id }}">
                  </td>
                  <td>{{ $user->name }}</td>
                </tr>
              @endforeach
            </table>
            {{ $users->links() }}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary"
            data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary"
            id="inviteButton">Invitar</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  </div>
@endsection

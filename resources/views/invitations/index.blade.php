@extends('layouts.app')

@section('content')

  <div class="events d-flex flex-wrap justify-content-center">
    @if ($invitations->isNotEmpty())
      @foreach ($invitations as $invitation)
        <div class="card m-2" style="max-width: 18rem;">
          <div class="card-body">
            <h3 class="card-title">{{ $invitation->event->name }}</h3>
            <h6 class="card-subtitle mb-2 text-body-secondary">${{ number_format($invitation->event->price, 0) }}</h6>
            <p class="card-text truncate">{{ $invitation->event->description }}</p>

            <!-- Botón de Aceptar -->
            <form action="{{ route('invitations.update', $invitation->id) }}" method="POST" class="mb-2">
              @csrf
              @method('PUT')
              <input type="hidden" name="state_id" value="2"> <!-- 2 es el ID para 'aceptado' -->
              <button type="submit" class="btn btn-success w-100">Aceptar</button>
            </form>

            <!-- Botón de Rechazar -->
            <form action="{{ route('invitations.update', $invitation->id) }}" method="POST">
              @csrf
              @method('PUT')
              <input type="hidden" name="state_id" value="3">
              <button type="submit" class="btn btn-danger w-100">Rechazar</button>
            </form>
          </div>
        </div>
      @endforeach
    @else
      <h3>No tienes invitaciones</h3>
    @endif
  </div>

  <!-- Paginación -->
  <div class="d-flex justify-content-center mt-4">
    {{ $invitations->links() }}
  </div>

@endsection

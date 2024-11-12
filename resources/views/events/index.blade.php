@extends('layouts.app')

@section('content')
@auth
  @php
    $user = auth()->user();
  @endphp
  @if ($user->rol === 'admin' || $user->rol === 'organizador')
    <a href="{{ route('events.create') }}">
      <button class="btn btn-primary">+ Crear</button>
    </a>
  @endif
@endauth
  <div class="events d-flex flex-wrap justify-content-center">
    @foreach ($events as $event)
      <div class="card m-2" style="max-width: 18rem;">
        <div class="card-body">
          <h3 class="card-title">{{ $event->name }}</h3>
          <h6 class="card-subtitle mb-2 text-body-secondary">{{ $event->price }}</h6>
          <p class="card-text truncate">{{ $event->description }}</p>
          <a href="{{ route('events.show', $event->id) }}">
            <button class="btn btn-outline-primary">Ver</button>
          </a>
        </div>
      </div>
    @endforeach
  </div>

  {{ $events->links() }}
@endsection

@extends('layouts.app')

@section('content')
  <form action="{{ route('events.update', $event->id) }}" method="POST" class="row g-3 needs-validation" novalidate>
    @csrf
    @method('PUT') 
    <input type="hidden" value="{{ $event->id }}" name="id">
    <div class="col-md-6">
      <label for="eventName" class="form-label">Nombre del evento</label>
      <input type="text" class="form-control" id="eventName" name="name" value="{{ old('name', $event->name) }}"
        required>
      <div class="invalid-feedback">
        Por favor, ingrese el nombre del evento.
      </div>
    </div>

    <div class="col-md-6">
      <label for="eventDescription" class="form-label">Descripción</label>
      <input type="text" class="form-control" id="eventDescription" name="description"
        value="{{ old('description', $event->description) }}" required>
      <div class="invalid-feedback">
        Por favor, ingrese una descripción válida.
      </div>
    </div>

    <div class="col-md-6">
      <label for="eventStart" class="form-label">Fecha y hora de inicio</label>
      <input type="datetime-local" class="form-control" id="eventStart" name="date"
        value="{{ old('date', $event->date instanceof \DateTime ? $event->date->format('Y-m-d\TH:i') : $event->date) }}"
        required>
      <div class="invalid-feedback">
        Por favor, ingrese la fecha y hora de inicio.
      </div>
    </div>

    <div class="col-md-6">
      <label for="eventLocation" class="form-label">Ubicación (física o virtual)</label>
      <input type="text" class="form-control" id="eventLocation" name="location"
        value="{{ old('location', $event->location) }}" required>
      <div class="invalid-feedback">
        Por favor, ingrese la ubicación del evento.
      </div>
    </div>

    <div class="col-md-6">
      <label for="eventCost" class="form-label">Costo</label>
      <input type="number" class="form-control" id="eventCost" name="price" value="{{ old('price', $event->price) }}"
        required>
      <div class="invalid-feedback">
        Por favor, ingrese el costo del evento.
      </div>
    </div>

    <div class="col-12">
      <button class="btn btn-primary" type="submit">Actualizar evento</button>
    </div>
  </form>
@endsection

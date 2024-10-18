@extends('layouts.app')

@section('content')
<form action="{{ route('events.store') }}" method="POST" class="row g-3 needs-validation" novalidate>
    @csrf

    <div class="col-md-6">
      <label for="eventName" class="form-label">Nombre del evento</label>
      <input type="text" class="form-control" id="eventName" name="name" required>
      <div class="invalid-feedback">
        Por favor, ingrese el nombre del evento.
      </div>
    </div>
    <div class="col-md-6">
      <label for="eventDescription" class="form-label">Descripción</label>
      <input type="text" class="form-control" id="eventDescription" name="description" required>
      <div class="invalid-feedback">
        Por favor, ingrese una descripción válida.
      </div>
    </div>
    <div class="col-md-6">
      <label for="eventStart" class="form-label">Fecha y hora de inicio</label>
      <input type="datetime-local" class="form-control" id="eventStart" name="date" required>
      <div class="invalid-feedback">
        Por favor, ingrese la fecha y hora de inicio.
      </div>
    </div>
  
    <div class="col-md-6">
      <label for="eventLocation" class="form-label">Ubicación (física o virtual)</label>
      <input type="text" class="form-control" id="eventLocation" name="location" required>
      <div class="invalid-feedback">
        Por favor, ingrese la ubicación del evento.
      </div>
    </div>
    <div class="col-md-6">
      <label for="eventCost" class="form-label">Costo</label>
      <input type="number" class="form-control" id="eventCost" name="price" required>
      <div class="invalid-feedback">
        Por favor, ingrese el costo del evento.
      </div>
    </div>
    <div class="col-12">
      <button class="btn btn-primary" type="submit">Crear evento</button>
    </div>
</form>

@endsection
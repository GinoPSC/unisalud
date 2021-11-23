@extends('layouts.app')

@section('content')

@include('samu.nav')

<h3 class="mb-3"><i class="fas fa-blender-phone"></i> Listado de Turnos
    @if($allowCreate)
    <a class="btn btn-success float-right" href="{{ route('samu.shift.create') }}">
        <i class="fas fa-plus"></i> Crear turno
    </a>
    @else
    <button class="btn btn-outline-success float-right" disabled readonly>
        <i class="fas fa-plus"></i> Hay un turno abierto
    </button>
    @endif
</h3>

<div class="table-responsive">
    <table class="table table-striped">
        
        <thead>
            <tr class="table-primary">
                <th></th>
                <th>Estado</th>
                <th>Turno</th>
                <th>Apertura</th>
                <th>Cierre</th>
                <th>Personal</th>
                <th></th>
            </tr>
        </thead>
        
        <tbody>
            @foreach($shifts as $shift)
            <tr>
                <td>
                    <a href="{{ route('samu.shift.edit', $shift) }}">
                        <button class="btn btn-outline-primary"><i class="fas fa-edit"></i></button>
                    </a>
                </td>
                <td>{{ ($shift->status === 0) ? 'Cerrado':'Abierto' }} </td>
                <td>{{ $shift->type }}</td>
                <td>{{ $shift->opening_at->format('Y-m-d H:i') }}</td>
                <td>{{ optional($shift->closing_at)->format('Y-m-d H:i') }}</td>
                <td>
                    @livewire('samu.shift-user', ['shift_id' => $shift->id])
                </td>
                <td>
                    <form method="POST" action="{{ route('samu.shift.destroy', $shift) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        
    </table>
</div>

{{ $shifts->links('pagination::bootstrap-4') }}

@endsection

@section('custom_js')

@endsection
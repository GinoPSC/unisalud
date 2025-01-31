@extends('layouts.app')

@section('content')

@include('samu.nav')

<h3 class="mb-3"><i class="fas fa-clipboard-check"></i> Regulación de llamadas
    <small class="float-right"><i class="far fa-calendar-alt"></i> Fecha de registro: {{ date('Y-m-d') }}</small>
</h3>

@unless($openShift)
    <div class="alert alert-warning" role="alert">
        No hay un turno abierto
    </div>
@endunless

@foreach([$openShift,$lastShift] as $shift)
    @unless($shift == null)

        <h3 class="mb-3">Registro de llamadas turno: {{ optional(optional($shift)->opening_at)->format('Y-m-d H:i') }}</h3>
        @include('samu.call.partials.list', ['calls' => $shift->calls->where('classification','<>','OT')->sortByDesc('id'), 'edit' => true])
   
    <!-- fin de registro de llamadas-->
    @endunless
@endforeach


@endsection

@section('custom_js')

@endsection

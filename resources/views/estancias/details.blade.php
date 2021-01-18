@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="card">
            <h1 class="card-head" style="text-align: center">{{$estancia->numero}}</h1>
                <div class="row card-body" style="text-align: center">
                    <div class="col-12">
                        <img src="{{$estancia->foto}}" alt="">
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            ID:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$estancia->id}}
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Número:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$estancia->numero}}
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Tipo
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$estancia->tipo}}
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            @if($estancia->tipo === "HABITACION")
                                Plazas
                            @else
                                Aforo
                            @endif
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        @if($estancia->tipo === "HABITACION")
                            {{$estancia->plazas}}
                        @else
                            {{$estancia->aforo}}
                        @endif
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Descripción:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$estancia->descripcion}}
                    </div>
                    @if($estancia->tipo === "HABITACION")
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Vistas:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$estancia->vistas}}
                    </div>
                    @endif
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Tarifa base:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$estancia->tarifa_base}}€
                    </div>
                    <div class="col-12" style="text-align: center">
                        <a class="btn btn-danger" style="text-align: center">
                            {{ __('Eliminar') }}
                        </a>
                        <a href="/estancias/{{$estancia->id}}/edit" class="btn btn-secondary" style="text-align: center">
                            {{ __('Editar') }}
                        </a>
                    </div>
                </div>
            </div>
            <br />  
            <div style="text-align: center">
                <a href="/estancias" class="btn btn-secondary">
                    {{ __('Volver al listado') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
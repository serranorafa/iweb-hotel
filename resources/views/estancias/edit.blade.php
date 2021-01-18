@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 style="text-align: center">{{ __('Editar') }} {{$estancia->id}}</h1>
            <div class="card">
                <div class="card-body" style="text-align: left">
                    <form action="{{url('estanciaeditada')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$estancia->id}}">
                        <div class="form-group row">
                            <label for="numero" class="col-md-4 col-form-label text-md-right">{{ __('Número') }}</label>
                            <div class="col-md-6">
                            <input id="numero" type="number" class="form-control @error('numero') is-invalid @enderror" name="numero" value="{{$estancia->numero}}" required autocomplete="numero" autofocus>
                                @error('numero')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="tipo" class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>
                            <div class="col-md-6">
                                <select id="tipo" name="tipo" autofocus onchange="cambiarVisibilidad()">
                                    <option value="HABITACION" @if($estancia->tipo === "HABITACION") selected @endif>Habitación</option>
                                    <option value="SALA" @if($estancia->tipo === "SALA") selected @endif>Sala</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="planta" class="col-md-4 col-form-label text-md-right">{{ __('Planta') }}</label>
                            <div class="col-md-6">
                                <input id="planta" type="number" class="form-control @error('planta') is-invalid @enderror" name="planta" value="{{$estancia->planta}}" required autocomplete="planta" autofocus>
                                @error('planta')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group row habitacion" style="@if($estancia->tipo === 'HABITACION')visibility: visible @else visibility: hidden @endif">
                            <label for="plazas" class="col-md-4 col-form-label text-md-right">{{ __('Plazas') }}</label>
                            <div class="col-md-6">
                                <input id="plazas" type="number" class="form-control @error('plazas') is-invalid @enderror" name="plazas" value="{{$estancia->plazas}}" autocomplete="plazas" autofocus>
                                @error('plazas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group row habitacion" style="@if($estancia->tipo === 'HABITACION')visibility: visible @else visibility: hidden @endif">
                            <label for="vistas" class="col-md-4 col-form-label text-md-right">{{ __('Vistas') }}</label>
                            <div class="col-md-6">
                                <input id="vistas" type="text" class="form-control @error('vistas') is-invalid @enderror" name="vistas" value="{{$estancia->vistas}}" autocomplete="vistas" autofocus>
                                @error('vistas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group row sala" style="@if($estancia->tipo === 'HABITACION')visibility: hidden @else visibility: visible @endif">
                            <label for="aforo" class="col-md-4 col-form-label text-md-right">{{ __('Aforo') }}</label>
                            <div class="col-md-6">
                                <input id="aforo" type="number" class="form-control @error('aforo') is-invalid @enderror" name="aforo" value="{{$estancia->aforo}}" autocomplete="aforo" autofocus>
                                @error('aforo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>
                            <div class="col-md-6">
                                <textarea id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" required autocomplete="descripcion" autofocus>{{$estancia->descripcion}}</textarea>
                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="tarifa_base" class="col-md-4 col-form-label text-md-right">{{ __('Tarifa base') }}</label>

                            <div class="col-md-6">
                                <input id="tarifa_base" type="number" class="form-control @error('tarifa_base') is-invalid @enderror" name="tarifa_base" value="{{$estancia->tarifa_base}}" required autocomplete="tarifa_base" autofocus>
                                @error('tarifa_base')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group row" style="text-align: center">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-secondary">
                                    {{ __('Actualizar') }}
                                </button>
                            </div>
                        </div>
                    </form>
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
<script>
function cambiarVisibilidad(){
    if(document.getElementById("tipo").value === "HABITACION"){
        var habitacion = document.getElementsByClassName("habitacion");
        for(i=0; i<habitacion.length; i++)
        {
            habitacion[i].setAttribute("style", "visibility: visible");
        }
        var sala = document.getElementsByClassName("sala");
        for(i=0; i<sala.length; i++)
        {
            sala[i].setAttribute("style", "visibility: hidden");
        }
    }
    else{
        var habitacion = document.getElementsByClassName("habitacion");
        for(i=0; i<habitacion.length; i++)
        {
            habitacion[i].setAttribute("style", "visibility: hidden");
        }        var sala = document.getElementsByClassName("sala");
        for(i=0; i<sala.length; i++)
        {
            sala[i].setAttribute("style", "visibility: visible");
        }
    }
}
</script>
@endsection

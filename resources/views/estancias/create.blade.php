@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 style="text-align: center">{{ __('Crear estancia') }}</h1>
            <div class="card">
                <div class="card-body" style="text-align: left">
                    <form action="{{url('estanciacreada')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="numero" class="col-md-4 col-form-label text-md-right">{{ __('Número') }}</label>

                            <div class="col-md-6">
                            <input id="numero" type="number" class="form-control @error('numero') is-invalid @enderror" name="numero" value="{{ old('numero') }}" required autocomplete="numero" autofocus>
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
                                <select id="tipo" class="form-control" name="tipo" value="{{ old('tipo') }}" autofocus onchange="cambiarVisibilidad()">
                                    <option value="HABITACION">Habitación</option>
                                    <option value="SALA">Sala</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="planta" class="col-md-4 col-form-label text-md-right">{{ __('Planta') }}</label>
                            <div class="col-md-6">
                                <input id="planta" type="number" class="form-control @error('planta') is-invalid @enderror" name="planta" value="{{ old('planta') }}" required autocomplete="planta" autofocus>
                                @error('planta')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group row habitacion" style="visibility:visible">
                            <label for="plazas" class="col-md-4 col-form-label text-md-right">{{ __('Plazas') }}</label>
                            <div class="col-md-6">
                                <input id="plazas" type="number" class="form-control @error('plazas') is-invalid @enderror" name="plazas" value="{{ old('plazas') }}" autocomplete="plazas" autofocus>
                                @error('plazas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group row habitacion" style="visibility:visible">
                            <label for="vistas" class="col-md-4 col-form-label text-md-right">{{ __('Vistas') }}</label>
                            <div class="col-md-6">
                                <select id="vistas" class="form-control" name="vistas" value="{{ old('vistas') }}" autofocus>
                                    <option value="Vistas a piscina">Vistas a piscina</option>
                                    <option value="Vistas al jardin">Vistas al jardin</option>
                                    <option value="Vistas al mar">Vistas al mar</option>
                                    <option value="Vistas al aparcamiento">Vistas al aparcamiento</option>
                                </select>
                                @error('vistas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group row sala" style="visibility:hidden">
                            <label for="aforo" class="col-md-4 col-form-label text-md-right">{{ __('Aforo') }}</label>
                            <div class="col-md-6">
                                <input id="aforo" type="number" class="form-control @error('aforo') is-invalid @enderror" name="aforo" autocomplete="aforo" value="{{ old('aforo') }}" autofocus>
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
                                <textarea id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{ old('descripcion') }}" required autocomplete="descripcion" autofocus></textarea>
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
                                <input id="tarifa_base" type="number" class="form-control @error('tarifa_base') is-invalid @enderror" name="tarifa_base" value="{{ old('tarifa_base') }}" required autocomplete="tarifa_base" autofocus>
                                @error('tarifa_base')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="foto" class="col-md-4 col-form-label text-md-right">{{ __('Imagen') }}</label>

                            <div class="col-md-6">
                                <input id="foto" type="file" accept="image/jpeg, image/jpg, image/png" class="form-control" name="fotos[]" required autocomplete="foto" autofocus multiple>
                                @if(count($errors)>0)
                                    <div class="alert alert-danger">
                                        {{ $errors->first() }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="form-group row" style="text-align: center">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-secondary">
                                    {{ __('Crear') }}
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

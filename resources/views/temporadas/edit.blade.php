@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h1 class="card-header" style="text-align: center">{{ __('Editar') }} {{$temporada->nombre}}</h1>
                <div class="card-body" style="text-align: left">
                    <form action="{{url('temporadaeditada')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$temporada->id}}">
                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{$temporada->nombre}}" required autocomplete="name" autofocus>

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="fecha_inicio" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de inicio') }} <span class="badge btn-secondary" data-placement="top" title="El año es irrelevante">i</span></label>

                            <div class="col-md-6">
                                <input id="fecha_inicio" type="date" class="form-control @error('fecha_inicio') is-invalid @enderror" name="fecha_inicio" value="{{$temporada->fecha_inicio}}" required autocomplete="fecha_inicio" autofocus>

                                @error('fecha_inicio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="fecha_fin" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de fin') }} <span class="badge btn-secondary" data-placement="top" title="El año es irrelevante">i</span></label>

                            <div class="col-md-6">
                                <input id="fecha_fin" type="date" class="form-control @error('fecha_fin') is-invalid @enderror" name="fecha_fin" value="{{$temporada->fecha_fin}}" required autocomplete="fecha_fin">

                                @error('fecha_fin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="mod_temporada" class="col-md-4 col-form-label text-md-right">{{ __('Modificador de temporada') }}</label>

                            <div class="col-md-6">
                                <input id="mod_temporada" type="number" class="form-control @error('mod_temporada') is-invalid @enderror" name="mod_temporada" value="{{$temporada->mod_temporada}}" required autocomplete="mod_temporada" autofocus>

                                @error('mod_temporada')
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
                <a href="/temporadas/{{$temporada->id}}" class="btn btn-secondary">
                    {{ __('Volver a los detalles') }}
                </a>
                <a href="/temporadas" class="btn btn-secondary">
                    {{ __('Volver al listado') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

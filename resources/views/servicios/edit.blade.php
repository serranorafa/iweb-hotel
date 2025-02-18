@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h1 class="card-header" style="text-align: center">{{ __('Editar') }} {{$servicio->nombre}}</h1>
                <div class="card-body" style="text-align: left">
                    <form action="{{url('servicioeditado')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$servicio->id}}">
                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                            <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{$servicio->nombre}}" required autocomplete="nombre" autofocus>
                                @error('nombre')
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
                                <textarea id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" required autocomplete="descripcion" autofocus>{{$servicio->descripcion}}</textarea>
                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="tarifa" class="col-md-4 col-form-label text-md-right">{{ __('Tarifa diaria') }}</label>

                            <div class="col-md-6">
                                <input id="tarifa" type="number" class="form-control @error('tarifa') is-invalid @enderror" name="tarifa" value="{{$servicio->tarifa}}" required autocomplete="tarifa" autofocus>
                                @error('tarifa')
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
                <a href="/servicios/{{$servicio->id}}" class="btn btn-secondary">
                    {{ __('Volver a los detalles') }}
                </a>
                <a href="/servicios" class="btn btn-secondary">
                    {{ __('Volver al listado') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

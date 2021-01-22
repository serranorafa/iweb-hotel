@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h1 class="card-header" style="text-align: center">{{ __('Editar bloqueo') }} {{$bloqueo->id}}</h1>
                <div class="card-body" style="text-align: left">
                    <form action="{{url('bloqueoeditado')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$bloqueo->id}}">
                        <div class="form-group row">
                            <label for="estancia_id" class="col-md-4 col-form-label text-md-right">{{ __('Número de estancia') }}</label>

                            <div class="col-md-6">
                            <select class="form-control" id="estancia_id" name="estancia_id" autofocus required>
                                @foreach($estancias as $estancia)
                                    @if($bloqueo->getEstancia->id === $estancia->id)
                                    <option value="{{$estancia->id}}" selected>{{$estancia->numero}}</option>
                                    @else
                                    <option value="{{$estancia->id}}">{{$estancia->numero}}</option>
                                    @endif
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="fecha_inicio" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de inicio') }}</label>

                            <div class="col-md-6">
                                <input id="fecha_inicio" type="date" class="form-control @error('fecha_inicio') is-invalid @enderror" name="fecha_inicio" value="{{date('Y-m-d', strtotime($bloqueo->fecha_inicio))}}" required autocomplete="fecha_inicio" autofocus>

                                @error('fecha_inicio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="fecha_fin" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de fin') }}</label>

                            <div class="col-md-6">
                                <input id="fecha_fin" type="date" class="form-control @error('fecha_fin') is-invalid @enderror" name="fecha_fin" value="{{date('Y-m-d', strtotime($bloqueo->fecha_fin))}}" required autocomplete="fecha_fin">

                                @error('fecha_fin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="hora_inicio" class="col-md-4 col-form-label text-md-right">{{ __('Hora de inicio') }}</label>

                            <div class="col-md-6">
                                <input id="hora_inicio" type="time" class="form-control @error('hora_inicio') is-invalid @enderror" name="hora_inicio" value="{{date('H:i', strtotime($bloqueo->fecha_inicio))}}" required autocomplete="hora_inicio" autofocus>

                                @error('hora_inicio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="hora_fin" class="col-md-4 col-form-label text-md-right">{{ __('Hora de fin') }}</label>

                            <div class="col-md-6">
                                <input id="hora_fin" type="time" class="form-control @error('hora_fin') is-invalid @enderror" name="hora_fin" value="{{date('H:i', strtotime($bloqueo->fecha_fin))}}" required autocomplete="hora_fin">

                                @error('hora_fin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
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
                <a href="/bloqueos/{{$bloqueo->id}}" class="btn btn-secondary">
                    {{ __('Volver a los detalles') }}
                </a>
                <a href="/bloqueos" class="btn btn-secondary">
                    {{ __('Volver al listado') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

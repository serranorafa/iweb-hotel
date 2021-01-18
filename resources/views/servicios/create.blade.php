@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 style="text-align: center">{{ __('Crear servicio') }}</h1>
            <div class="card">
                <div class="card-body" style="text-align: left">
                    <form method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                            <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" required autocomplete="nombre" autofocus>
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
                                <textarea id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" required autocomplete="descripcion" autofocus></textarea>
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
                                <input id="tarifa" type="number" class="form-control @error('tarifa') is-invalid @enderror" name="tarifa" required autocomplete="tarifa" autofocus>
                                @error('descripcion')
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
                                    {{ __('Crear') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br />  
            <div style="text-align: center">
                <a href="/servicios" class="btn btn-secondary">
                    {{ __('Volver al listado') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

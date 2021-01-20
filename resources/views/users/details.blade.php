@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="card">
            <h1 class="card-head" style="text-align: center">{{$user->nombre}} {{$user->apellidos}}</h1>
                <div class="row card-body" style="text-align: center">
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            ID:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$user->id}}
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Correo electrónico:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$user->email}}
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Nombre:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$user->nombre}}
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Apellidos:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$user->apellidos}}
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Rol:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$user->rol}}
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Teléfono:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$user->telefono}}
                    </div>
                    <div class="col-6"></div>
                    <div class="col-12" style="text-align: center">
                        <a onclick="confirmar('{{ $user->id }}')" class="btn btn-danger" style="text-align: center">
                            {{ __('Eliminar') }}
                        </a>
                        <a href="/users/{{$user->id}}/edit" class="btn btn-secondary" style="text-align: center">
                            {{ __('Editar') }}
                        </a>
                    </div>
                </div>
            </div>
            <br />  
            <div style="text-align: center">
                <a href="/users" class="btn btn-secondary">
                    {{ __('Volver al listado') }}
                </a>
            </div>
        </div>
    </div>
</div>
<script>
    function confirmar(usuario) {
        if (confirm("¿Confirmar el borrado?")) {
            window.location.href = "/borrarusuario/" + usuario;
        } else {
        }
    }   
</script>
@endsection
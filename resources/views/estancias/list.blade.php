@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 style="text-align: center">{{ __('Estancias') }}</h1>
            <div class="card" style="text-align: left">
                <h4 class="card-header" style="text-align: center">{{ __('Búsqueda') }}</h4>
                <div class="card-body">
                    <form action="{{url('estancias')}}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="numero" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Número') }}</label>

                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <input id="numero" class="form-control" type="number" name="numero" autocomplete="numero" autofocus>
                            </div>
                            <label for="planta" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Planta') }}</label>
                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <input id="planta" class="form-control" type="number" name="planta" autocomplete="planta" autofocus>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="tipo" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Tipo') }}</label>
                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <select id="comparacion" name="comparacion" autofocus onchange="cambiarHabSala()">
                                    <option value="" selected>Cualquiera</option>
                                    <option value="HABITACION">Habitación</option>
                                    <option value="SALA">Sala</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-11 card" style="margin-left: 4.5%;margin-right: 5%; margin-top: 2%; padding-bottom:2%">
                                <div id="tarifaInput">
                                        <label for="tarifa_base" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Tarifa base') }}</label>
                                        <div class="col-lg-4 col-12" style="padding-right: 10%">
                                            <input id="tarifa_base" class="form-control" type="number" name="tarifa_base" autocomplete="tarifa_base" autofocus>
                                        </div>
                                    </div>
                                <div id="plazasInput">
                                    <label for="plazas" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Plazas (sólo habitaciones)') }}</label>
                                    <div class="col-lg-4 col-12" style="padding-right: 10%">
                                        <input id="plazas" class="form-control" type="number" name="plazas" autocomplete="plazas" autofocus>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                </div>                                
                                <div id="aforoInput">
                                    <label for="aforo" class="col-lg-4 col-12 col-form-label text-md-right">{{ __('Aforo mínimo (sólo salas de conferencias)') }}</label>
                                    <div class="col-lg-4 col-12" style="padding-right: 10%">
                                        <input id="aforo" class="form-control" type="number" name="aforo" autocomplete="aforo" autofocus>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group row" style="text-align: center">
                            <div class="col-12">
                                <button type="submit" class="btn btn-secondary" style="text-align: center"> 
                                    {{ __('Aplicar filtros') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            @if(Auth::user()->rol == "WEBMASTER")
            <div style="text-align: center">
               <a href="/estancias/create" class="btn btn-secondary">+ Nueva estancia</a>
            </div>
            <br>
            @endif
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Núm.</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Planta</th>
                    <th scope="col">Plazas</th>
                    <th scope="col">Aforo</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    @if(Auth::user()->rol == "WEBMASTER")
                    <th scope="col"></th>
                    @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($estancias as $estancia)
                    <tr>
                        <th scope="row">{{$estancia->numero}}</th>
                        <td>{{$estancia->tipo}}</td>
                        <td>{{$estancia->planta}}</td>
                        @if($estancia->tipo === "HABITACION")
                            <td>{{$estancia->plazas}}</td>
                        @else
                            <td>-</td>
                        @endif
                        @if($estancia->tipo === "SALA")
                            <td>{{$estancia->aforo}}</td>
                        @else
                            <td>-</td>
                        @endif
                        <td><a href="/estancias/{{$estancia->id}}">Detalles</a></td>
                        <td><a href="/estancias/{{$estancia->id}}/edit">Editar</a></td>
                        @if(Auth::user()->rol == "WEBMASTER")
                        <td><a onclick="confirmar('{{ $estancia->id }}')" href="#">Eliminar</a></td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="align-items: center">
            <div style="width:max-content; margin:auto">
            {{ $estancias->appends(Request::all())->links() }}
            </div>
            </div>
        </div>
    </div>
</div>
<script>
    function confirmar(estancia) {
        if (confirm("¿Confirmar el borrado?")) {
            window.location.href = "/borrarestancia/" + estancia;
        } else {
        }
    }  
    
    function cambiarHabSala() {
        var tipoEstancia = document.getElementById("comparacion").value;
        
        if (tipoEstancia == "HABITACION") {
            document.getElementById("plazasInput").style.display = "block";
            document.getElementById("aforoInput").style.display = "none";
        }
        else if (tipoEstancia == "SALA") {
            document.getElementById("plazasInput").style.display = "none";
            document.getElementById("aforoInput").style.display = "block";
        }
        else {
            document.getElementById("plazasInput").style.display = "block";
            document.getElementById("aforoInput").style.display = "block";
        }
    }
</script>
@endsection
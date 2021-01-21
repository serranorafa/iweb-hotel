@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">            
            <div class="card">
                <h1 class="card-header" style="text-align: center">{{ __('Reserva') }}</h1>
                <div class="card-body" style="text-align: left">
                    <form action="{{url('reservas/habitacion')}}" method="POST">
                        @csrf
                        <!-- FECHAS -->
                        <h4 class="pb-3" style="text-align: center">{{__('Elige las fechas')}}</h4>
                        <div class="form-group row">
                            <label for="fecha_inicio" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Fecha inicio') }}</label>
                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <input id="fecha_inicio" class="form-control" type="date" name="fecha_inicio" autocomplete="fecha_inicio" autofocus required >
                                @error('fecha_inicio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="fecha_fin" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Fecha fin') }}</label>
                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <input id="fecha_fin" class="form-control" type="date" name="fecha_fin" autocomplete="fecha_fin" autofocus required>
                                @error('fecha_fin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="hora_inicio" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Hora inicio') }}</label>
                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <input id="hora_inicio" class="form-control" type="time" name="hora_inicio" autocomplete="hora_inicio" autofocus required >
                                @error('hora_inicio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="hora_fin" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Hora fin') }}</label>
                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <input id="hora_fin" class="form-control" type="time" name="hora_fin" autocomplete="hora_fin" autofocus required>
                                @error('hora_fin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <hr />
                        <h4 id="misala" class="pb-3" style="text-align: center; display: none">{{__('Mi reserva')}}</h4>
                        <div id="salaElegida" style="display: none">
                            <table id="listaSalaElegida" class="table">
                                    <thead>
                                        <tr>   
                                        <th></th>
                                        <th scope="col">Planta</th> 
                                        <th scope="col">Tarifa base/noche</th>
                                        <th scope="col">Aforo</th> 
                                        <th></th>
                                        <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="filasSalas">
                                    </tbody>
                                </table>
                                <h4 class="pb-3 mt-5" style="text-align: center">{{__('Elige servicio extra')}}</h4>
                                <div class="row" style="text-align: center">
                                    <div class="col-md-4 col-12">
                                        <select class="form-control" id="servicio" name="servicio" autofocus onchange="descripcionServicio()">
                                            <option value="SS" selected>Solo sala</option>
                                            <option value="SC">Cáterin</option>
                                            <option value="SAA">Sala con asistentes</option>
                                            <option value="SCA">Cáterin y asistentes</option>
                                        </select>                          
                                    </div>
                                    <label class="col-md-8 col-12" id="descripcion" style="text-align: left"></label>
                                </div>
                                @if(Auth::user()->rol == "RECEPCIONISTA" || Auth::user()->rol == "WEBMASTER")
                                <hr />
                                <h4 class="pb-3 mt-5" style="text-align: center">{{__('Usuario')}}</h4>
                                <div class="row" style="text-align: center">
                                    <div class="col-12" style="text-align: center">
                                        <select class="form-control" id="usuario" name="usuario" style="width: 40%; display: inline" autofocus>
                                            <option value="" selected>-</option>
                                            <option value="anonimo">Anónimo</option>
                                            @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->getId()}}">{{$usuario->getEmail()}}</option>
                                            @endforeach
                                        </select>                          
                                    </div>
                                </div>
                                <br>
                                @endif
                                <div style="clear: both; height: 2vh">
                                </div>
                                <div class="form-group row" style="text-align: center">
                                    <div class="col-md-12">
                                        <button type="button" onclick="hacerReserva()" class="btn btn-primary btn-lg mb-2">
                                            {{ __('Hacer reserva') }}
                                        </button>
                                    </div>
                                </div>
                            <hr>
                        </div>
                        <br>
                        <div class="form-group row" style="text-align: center">
                            <label for="aforo" class="text-md-right">{{ __('Aforo mínimo') }}</label>
                            <div><br></div>
                            <div class="col-12" style="text-align: center">
                                <input id="aforo" class="form-control" style="width: 17%; display: inline" type="number" name="aforo" autocomplete="aforo" autofocus>
                            </div>
                        </div>
                        <div style="clear: both; height: 2vh">
                        </div>
                        <div class="form-group row" style="text-align: center">
                            <div class="col-md-12">
                                <button onclick="buscarSalas()" type="button" class="btn btn-secondary mt-4">
                                    {{ __('Buscar salas') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div id="barra" style="display: none"><hr/><br></div>
                    <h4 id="eligeSala" class="pb-3" style="text-align: center; display: none">{{__('Elige sala')}}</h4>
                    <table id="listaSalas" class="table" style="display: none">
                        <thead>
                            <tr>   
                            <th scope="col">ID</th>                        
                            <th scope="col">Planta</th>
                            <th scope="col">Aforo</th>
                            <th scope="col">Tarifa base/hora</th>                
                            <th scope="col"></th>                      
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="filasBusqueda">
                        </tbody>
                    </table>
                    

                </div> <!-- card body -->
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", descripcionServicio());

    function anyadirSala(sala) {
        var objSala = sala;

        var tabla = document.getElementById('filasSalas');
        document.getElementById('barra').style.display = 'none';
        document.getElementById('eligeSala').style.display = 'none';
        document.getElementById('listaSalas').style.display = 'none';
        document.getElementById('salaElegida').style.display = 'block';
        document.getElementById('misala').style.display = 'block';
        document.getElementById(objSala.id).style.display = 'none';

        var fila = tabla.insertRow(-1); 
        fila.setAttribute("id", "fila" + objSala.id)
        var numero = fila.insertCell(0);
        var planta = fila.insertCell(1);
        var tarifa = fila.insertCell(2);
        var aforo = fila.insertCell(3);
        var btnDetalles = fila.insertCell(4);
        var btnEliminar = fila.insertCell(5);
        
        numero.innerHTML = "Sala " + objSala.numero;
        aforo.innerHTML = objSala.aforo;
        tarifa.innerHTML = objSala.tarifa_base + "€";
        planta.innerHTML = objSala.planta;
        btnDetalles.innerHTML = '<a href="/estancias/' + objSala.id + '" target="_blank" rel="noopener noreferrer">Detalles</a>';
        btnEliminar.innerHTML = '<a href="#" onclick="eliminarSala(' + objSala.id + ')">Eliminar</a>';
    }

    function eliminarSala(id) {
        document.getElementById('fila' + id).remove();
        document.getElementById(id).style.display = 'table-row';

        document.getElementById('salaElegida').style.display = 'none';
        document.getElementById('misala').style.display = 'none';

        document.getElementById('barra').style.display = 'block';
        document.getElementById('eligeSala').style.display = 'block';
        document.getElementById('listaSalas').style.display = 'table';
    }

    async function hacerReserva() {
        if (confirm("¿Confirmar la reserva?")) {
            var sala = document.getElementById('filasSalas').childNodes[1];
            console.log(sala);
            var _fecha_inicio = document.getElementById('fecha_inicio').value;
            var _fecha_fin = document.getElementById('fecha_fin').value;
            var _hora_inicio = document.getElementById('hora_inicio').value;
            var _hora_fin = document.getElementById('hora_fin').value;
            var servicio = document.getElementById('servicio').value;
            var usuario = document.getElementById('usuario').value;

            var estancia = sala.getAttribute("id").slice(4);
            var token = '{{csrf_token()}}';
            var data = { fecha_inicio: _fecha_inicio, fecha_fin: _fecha_fin, hora_inicio: _hora_inicio, hora_fin: _hora_fin, estancia_id: estancia, servicio: servicio, usuario: usuario, _token: token };

            $.ajax({
                type: "post",
                url: "{{url('reservacreada')}}",
                data: data,
                success: function(msg) {
                    console.log('asdf')
                },
                async: false
            })

            window.location.href = "/reservas/sala";
        }
    }

    function salaElegida(id) {
        var salas = document.getElementById('filasSalas').childNodes;

        var i = 0;
        for (const sala of salas) {
            if (i != 0) {
                if (salas.getAttribute("id").slice(4) == id) {
                    return true;
                }
            }
            i++;
        }
        return false;
    }

    function buscarSalas() {
        if (document.getElementById('misala').style.display == 'block') {
            alert("Ya hay una sala elegida");
            return;
        }
        if (document.getElementById('fecha_inicio').value == '' ||
            document.getElementById('fecha_fin').value == '' ||
            document.getElementById('hora_inicio').value == '' ||
            document.getElementById('hora_fin').value == '') {
            alert("Faltan fechas por rellenar");
            return;
        }
        document.getElementById('filasBusqueda').innerHTML = "";
        var fecha_inicio = document.getElementById('fecha_inicio').value;
        var fecha_fin = document.getElementById('fecha_fin').value;
        var hora_inicio = document.getElementById('hora_inicio').value;
        var hora_fin = document.getElementById('hora_fin').value;
        var aforo = document.getElementById('aforo').value;
        var token = '{{csrf_token()}}';

        var data = { fecha_inicio: fecha_inicio, fecha_fin: fecha_fin, hora_inicio: hora_inicio, hora_fin: hora_fin, aforo: aforo, _token: token };

        $.ajax({
            type: "post",
            url: "{{url('reservas/buscarsala')}}",
            data: data,
            success: function (_response) {

                if (_response.salas.length > 0) {
                    document.getElementById('barra').style.display = 'block';
                    document.getElementById('eligeSala').style.display = 'block';
                    document.getElementById('listaSalas').style.display = 'table';
                    var tabla = document.getElementById('filasBusqueda');

                    _response.salas.forEach(sala => {
                        console.log(sala);
                        var fila = tabla.insertRow(-1); 
                        fila.setAttribute("id", sala.id)
                        var idSala = fila.insertCell(0);
                        var plantaSala = fila.insertCell(1);
                        var aforoSala = fila.insertCell(2);
                        var tarifaSala = fila.insertCell(3);
                        var btnDetalles = fila.insertCell(4);
                        var btnAynadir = fila.insertCell(5);

                        idSala.innerHTML = sala.id;
                        plantaSala.innerHTML = sala.planta;
                        aforoSala.innerHTML = sala.aforo;
                        tarifaSala.innerHTML = sala.tarifa_base + "€";
                        btnDetalles.innerHTML = '<a href="/estancias/' + sala.id + '" target="_blank" rel="noopener noreferrer">Detalles</a>';
                        btnAynadir.innerHTML = '<a href="#">Elegir</a>';
                        btnAynadir.onclick = function() {
                            anyadirSala(sala);
                        }
                        if (salaElegida(sala.id) == true) {
                            document.getElementById(sala.id).style.display = 'none';
                        }
                    })
                }
            }
        })
    }

    function descripcionServicio() {
        var servicio = document.getElementById('servicio').value;
        $.ajax({
            type: "get",
            url: "{{url('servicios')}}" + '/' + servicio + '/descripcion',
            success: function(_response) {
                document.getElementById('descripcion').innerHTML = _response.descripcion + " (+" + _response.tarifa + "€/hora)";
            }
        })
    }
</script>
@endsection

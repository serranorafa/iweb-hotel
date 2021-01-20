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
                            <label for="fecha_inicio" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Fecha entrada') }}</label>
                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <input id="fecha_inicio" class="form-control" type="date" name="fecha_inicio" autocomplete="fecha_inicio" autofocus required 
                                    value="<?php if(isset($_POST['fecha_inicio'])){ echo $_POST['fecha_inicio']; } ?>">
                                @error('fecha_inicio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="fecha_fin" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Fecha salida') }}</label>
                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <input id="fecha_fin" class="form-control" type="date" name="fecha_fin" autocomplete="fecha_fin" autofocus required
                                    value="<?php if(isset($_POST['fecha_fin'])){ echo $_POST['fecha_fin']; } ?>">
                                @error('fecha_fin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br><hr />
                        <!-- HABITACIONES -->
                        <h4 class="pb-3" style="text-align: center">{{__('Elige habitaciones')}}</h4>
                        <div class="form-group row">
                            <label for="plazas" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Huéspedes') }}</label>
                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <input id="plazas" class="form-control" type="number" name="plazas" autocomplete="plazas" autofocus
                                    value="<?php if(isset($_POST['plazas'])){ echo $_POST['plazas']; } ?>">
                                
                            </div>
                            <label for="vistas" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Vistas') }}</label>
                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <select id="vistas" name="vistas" autofocus>
                                    <option value="">Cualquiera</option>
                                    <option value="Vistas al jardin" <?php if(isset($_POST['vistas']) && $_POST['vistas']=="Vistas al jardin") echo "selected";?>>Vistas al jardín</option>
                                    <option value="Vistas a la piscina" <?php if(isset($_POST['vistas']) && $_POST['vistas']=="Vistas a la piscina") echo "selected";?>>Vistas a la piscina</option>
                                    <option value="Vistas al mar" <?php if(isset($_POST['vistas']) && $_POST['vistas']=="Vistas al mar") echo "selected";?>>Vistas al mar</option>
                                    <option value="Vistas al aparcamiento" <?php if(isset($_POST['vistas']) && $_POST['vistas']=="Vistas al aparcamiento") echo "selected";?>>Vistas al aparcamiento</option>
                                </select>                          
                            </div>
                        </div>
                        <br>
                        <div class="form-group row" style="text-align: center">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-secondary">
                                    {{ __('Buscar habitaciones') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    @if($habitaciones != [])
                    <br>
                    <table id="listaHabitaciones" class="table">
                        <thead>
                            <tr>   
                            <th scope="col">ID</th>                        
                            <th scope="col">Planta</th>
                            <th scope="col">Plazas</th>
                            <th scope="col">Tarifa base/noche</th>
                            <th scope="col">Vistas</th>                         
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($habitaciones as $habitacion)
                            <tr>  
                                <td>{{$habitacion->id}}</td>                             
                                <td>{{$habitacion->planta}}</td>                                
                                <td>{{$habitacion->plazas}}</td>
                                <td>{{$habitacion->tarifa_base}} €</td>
                                <td>{{$habitacion->vistas}}</td>                                 
                                <td><a href="/estancias/{{$habitacion->id}}">Detalles</a></td> 
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                    

                </div> <!-- card body -->
            </div>
        </div>
    </div>
</div>
@endsection

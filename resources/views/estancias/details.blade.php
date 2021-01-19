@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="card">
            <h1 class="card-head" style="text-align: center">{{$estancia->numero}}</h1>
                <div class="row card-body" style="text-align: center">
                    <div class="row">
                        @foreach($estancia->fotos as $foto)
                            <div class="gallerySlides">
                                <img src="{{ asset($dir . $foto->getRuta()) }}" style="max-width:100%; max-height: 350px">
                            </div>
                        @endforeach

                        <div class="galleryRow col-12" style="text-align: center; display: inline; height: 7%">
                            @foreach($estancia->fotos as $foto)
                                <div class="galleryColumn" style="display: inline">
                                    <img class="demo cursor" src="{{ asset($dir . $foto->getRuta()) }}" style="width:7%; display: inline" onclick="currentSlide({{ $loop->index }})" alt="texto alt">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div style="clear: both; height: 5vh">
                    </div>

                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            ID:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$estancia->id}}
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Número:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$estancia->numero}}
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Tipo
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$estancia->tipo}}
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            @if($estancia->tipo === "HABITACION")
                                Plazas
                            @else
                                Aforo
                            @endif
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        @if($estancia->tipo === "HABITACION")
                            {{$estancia->plazas}}
                        @else
                            {{$estancia->aforo}}
                        @endif
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Descripción:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$estancia->descripcion}}
                    </div>
                    @if($estancia->tipo === "HABITACION")
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Vistas:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$estancia->vistas}}
                    </div>
                    @endif
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Tarifa base:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$estancia->tarifa_base}}€
                    </div>
                    <div style="clear: both; height: 2vh">
                    </div>
                    <div class="col-12" style="text-align: center">
                        <a onclick="confirmar('{{ $estancia->id }}')" class="btn btn-danger" style="text-align: center">
                            {{ __('Eliminar') }}
                        </a>
                        <a href="/estancias/{{$estancia->id}}/edit" class="btn btn-secondary" style="text-align: center">
                            {{ __('Editar') }}
                        </a>
                    </div>
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
    function confirmar(estancia) {
        if (confirm("¿Confirmar el borrado?")) {
            window.location.href = "/borrarestancia/" + estancia;
        } else {
        }
    }   

    document.addEventListener("DOMContentLoaded", function(event) {
        var url = window.location.href;
        if (url.endsWith('roomGallery')) {
            document.getElementById("pestHabitaciones").classList.add("pestanyaActiva");
        }
        else if (url.endsWith('hallGallery')) {
            document.getElementById("pestSalas").classList.add("pestanyaActiva");
        }
        else if (url.endsWith('restaurantGallery')) {
            document.getElementById("pestRestaurante").classList.add("pestanyaActiva");
        }
    })

    var slideIndex = 1;
        showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
        showSlides(slideIndex = n + 1);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("gallerySlides");
        var dots = document.getElementsByClassName("demo");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
    }
</script>
@endsection
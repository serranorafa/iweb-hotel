@extends('layouts.app')

@section('content')
<div class="container">
    <!-- SELECTOR GALERÍA -->
    <nav class="navbar navbar-expand-md navbar-light bg-white" style="padding: 0px">
        <ul class="navbar-nav" style="width:100%;text-align: center">
            <li class="nav-item" style="width:100%">
                <a href="/roomGallery" id="pestHabitaciones" class="nav-link">Habitaciones</a>
            </li>
            <li class="nav-item" style="width:100%">
                <a href="/hallGallery" id="pestSalas" class="nav-link">Salas de conferencias</a>
            </li>
            <li class="nav-item" style="width:100%">
                <a href="/restaurantGallery" id="pestRestaurante" class="nav-link">Restaurante</a>
            </li>
        </ul>        
    </nav>

    <!-- FOTOS -->
    @foreach($photos as $photo)
        <div class="gallerySlides">
            <img src="{{ asset($dir . $photo->getFilename()) }}" style="width:100%">
        </div>
    @endforeach

    <!-- BOTONES ANTERIOR/SIGUIENTE -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

    <!-- MINIATURAS -->
    <div class="galleryRow">
        @foreach($photos as $photo)
            <div class="galleryColumn">
                <img class="demo cursor" src="{{ asset($dir . $photo->getFilename()) }}" style="width:100%" onclick="currentSlide({{ $loop->index }})" alt="texto alt">
            </div>
        @endforeach
    </div>
</div>

<script>
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
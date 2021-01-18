@extends('layouts.app')

@section('content')
<div class="container">
    <!-- SELECTOR GALERÍA -->
    <nav class="navbar navbar-expand-md navbar-light bg-white">
        <ul class="navbar-nav" style="width:100%;text-align: center">
            <li class="nav-item active" style="width:100%">
                <a href="#" class="nav-link" onclick="prueba()">Habitaciones</a>
            </li>
            <li class="nav-item active" style="width:100%">
                <a href="#" class="nav-link" onclick="prueba()">Salas de conferencias</a>
            </li>
            <li class="nav-item active" style="width:100%">
                <a href="#" class="nav-link" onclick="prueba()">Restaurante</a>
            </li>
        </ul>        
    </nav>

    <!-- FOTOS -->
    @foreach($salaPhotos as $salaPhoto)
        <div class="gallerySlides">
            <img src="{{ asset('/img/sala/' . $salaPhoto->getFilename()) }}" style="width:100%">
        </div>
    @endforeach

    <!-- BOTONES ANTERIOR/SIGUIENTE -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

    <!-- MINIATURAS -->
    <div class="galleryRow">
        @foreach($salaPhotos as $salaPhoto)
            <div class="galleryColumn">
                <img class="demo cursor" src="{{ asset('/img/sala/' . $salaPhoto->getFilename()) }}" style="width:100%" onclick="currentSlide({{ $loop->index }})" alt="texto alt">
            </div>
        @endforeach
    </div>
</div>

<script>
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

    function prueba() {
        console.log('HOLAAAAAAAAAAAAAAAAAAAAAAAAA')
    }
</script>
@endsection
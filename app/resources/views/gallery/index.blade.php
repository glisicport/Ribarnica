<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Galerija</title>
<style>
/* GLOBAL STIL */
body {
    background: radial-gradient(circle at top, #001027, #000814 60%, #00040f);
    color: #dff6ff;
}

/* Neon glow za tekst */
h1, h2 {
    text-shadow: 0 0 10px #1e90ff, 0 0 20px #0ff;
}

/* Slider pozadina */
#slider {
    background: rgba(0, 12, 30, 0.7) !important;
    border: 2px solid #00eaff50 !important;
    box-shadow: 0 0 25px #0077ff60;
}

/* Neon oko slika */
.slide img {
    box-shadow: 0 0 25px #00eaff80;
}

/* Prev / next dugmad */
.prev, .next {
    background: rgba(0, 10, 25, 0.7) !important;
    border: 2px solid #00eaff !important;
    color: #00eaff !important;
    box-shadow: 0 0 15px #00eaff;
}

.prev:hover, .next:hover {
    background: #00eaff !important;
    color: #00101f !important;
}

/* Dropdown stil */
#dropdownButton {
    cursor: pointer;
}

#dropdownMenu a {
    cursor: pointer;
    display: block;
}
</style>

@include('common.scripts')
</head>
<body>

@include('common.topbar')
<section class="mt-16 px-4 max-w-7xl mx-auto pb-20">
    <!-- Naslov Galerija -->
    <div class="text-center mb-16 relative">
        <div class="absolute inset-0 flex items-center justify-center opacity-10">
            <div class="w-96 h-96 bg-blue-500 rounded-full blur-3xl"></div>
        </div>
       <h1 class="text-5xl md:text-7xl font-black mb-4 text-white text-center">
        Galerija
        </h1>
        <div class="flex justify-center gap-2">
            <div class="w-16 h-1.5 bg-gradient-to-r from-transparent via-blue-500 to-transparent rounded-full"></div>
            <div class="w-16 h-1.5 bg-gradient-to-r from-transparent via-cyan-400 to-transparent rounded-full"></div>
            <div class="w-16 h-1.5 bg-gradient-to-r from-transparent via-blue-500 to-transparent rounded-full"></div>
        </div>
    </div>

    <!-- Centrirani dropdown meni -->
    <div class="flex justify-center mb-16">
        <div class="relative inline-block text-center">
            <button id="dropdownButton" class="inline-flex justify-center w-56 rounded-2xl bg-gradient-to-r from-blue-600 via-blue-500 to-cyan-500 text-white font-bold px-6 py-3 shadow-lg shadow-blue-500/50 hover:shadow-2xl hover:shadow-blue-500/60 transition-all duration-300 hover:scale-105 focus:outline-none">
                Kategorije
                <svg class="-mr-1 ml-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div id="dropdownMenu" class="hidden absolute mt-2 w-56 rounded-2xl shadow-lg shadow-blue-500/50 bg-gradient-to-r from-blue-700 via-cyan-600 to-blue-700 ring-1 ring-black ring-opacity-5 focus:outline-none z-30">
                <div class="py-1">
                    <a onclick="filterSlides('sve')" class="block px-4 py-2 text-white hover:bg-blue-500/50 hover:text-white transition duration-200">Sve</a>
                    <a onclick="filterSlides('enterijer')" class="block px-4 py-2 text-white hover:bg-blue-500/50 hover:text-white transition duration-200">Enterijer</a>
                    <a onclick="filterSlides('eksterijer')" class="block px-4 py-2 text-white hover:bg-blue-500/50 hover:text-white transition duration-200">Eksterijer</a>
                    <a onclick="showMeni()" class="block px-4 py-2 text-white hover:bg-blue-500/50 hover:text-white transition duration-200">Meni</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Slider -->
    <div class="relative bg-gradient-to-br from-blue-50 via-cyan-50 to-blue-100 rounded-3xl shadow-2xl overflow-hidden p-6 md:p-16 border border-blue-200/50" id="slider">
        <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-blue-400/20 to-cyan-400/20 rounded-full blur-3xl -z-0"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-gradient-to-tr from-cyan-400/20 to-blue-400/20 rounded-full blur-3xl -z-0"></div>

        @foreach($images as $image)
            @php
                $category = 'sve';
                if(stripos($image,'enterijer')!==false) $category='enterijer';
                elseif(stripos($image,'eksterijer')!==false) $category='eksterijer';
                $title = pathinfo($image, PATHINFO_FILENAME);
                $title = str_ireplace('enterijer','',$title);
                $title = str_replace('_',' ',$title);
                $title = ucwords(trim($title));
            @endphp
            <div class="slide hidden relative z-10" data-category="{{ $category }}">
                <div class="flex flex-col items-center">
                    <!-- Slika -->
                    <div class="relative w-full max-w-5xl mb-8 group">
                        <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 via-cyan-500 to-blue-600 rounded-3xl blur-2xl opacity-25 group-hover:opacity-50 transition duration-500"></div>
                        <div class="relative rounded-3xl overflow-hidden shadow-2xl ring-4 ring-white/50">
                            <img src="{{ asset('images/ambijent/'.$image) }}" alt="{{ $title }}" class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-blue-900/80 via-blue-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="absolute top-4 left-4 w-12 h-12 border-t-4 border-l-4 border-cyan-400 rounded-tl-xl opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                            <div class="absolute bottom-4 right-4 w-12 h-12 border-b-4 border-r-4 border-cyan-400 rounded-br-xl opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                        </div>
                    </div>

                    <!-- Naslov slike -->
                    <div class="text-center mt-6 relative w-full max-w-5xl">
                        <div class="absolute -inset-0 flex items-center justify-center opacity-10">
                            <div class="w-72 h-72 bg-blue-500 rounded-full blur-3xl"></div>
                        </div>
                        <h2 class="text-3xl md:text-5xl font-black mb-4 text-white text-center">
                            {{ $title }}
                        </h2>
                        <div class="flex justify-center gap-2">
                            <div class="w-12 h-1.5 bg-gradient-to-r from-transparent via-blue-500 to-transparent rounded-full"></div>
                            <div class="w-12 h-1.5 bg-gradient-to-r from-transparent via-cyan-400 to-transparent rounded-full"></div>
                            <div class="w-12 h-1.5 bg-gradient-to-r from-transparent via-blue-500 to-transparent rounded-full"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Navigaciona dugmad -->
        <button onclick="changeSlide(-1)" class="prev group absolute left-4 md:left-8 top-1/2 -translate-y-1/2 w-16 h-16 md:w-20 md:h-20 bg-white/95 backdrop-blur-md hover:bg-white text-blue-700 rounded-2xl shadow-2xl shadow-blue-900/20 hover:shadow-blue-500/40 transition-all duration-300 flex items-center justify-center text-3xl font-black hover:scale-110 active:scale-95 z-20 border-2 border-blue-200/50 hover:border-blue-400">
            <span class="group-hover:-translate-x-1 transition-transform duration-300">‹</span>
        </button>

        <button onclick="changeSlide(1)" class="next group absolute right-4 md:right-8 top-1/2 -translate-y-1/2 w-16 h-16 md:w-20 md:h-20 bg-white/95 backdrop-blur-md hover:bg-white text-blue-700 rounded-2xl shadow-2xl shadow-blue-900/20 hover:shadow-blue-500/40 transition-all duration-300 flex items-center justify-center text-3xl font-black hover:scale-110 active:scale-95 z-20 border-2 border-blue-200/50 hover:border-blue-400">
            <span class="group-hover:translate-x-1 transition-transform duration-300">›</span>
        </button>
    </div>
</section>

<style>
.slide {
    animation: slideIn 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

@keyframes slideIn {
    from { opacity: 0; transform: translateY(30px) scale(0.95); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}

* { scroll-behavior: smooth; }
</style>

<script>
let currentSlide = 0;
let slides = Array.from(document.querySelectorAll('.slide'));
let meniActive = false;

// Dropdown toggle
const dropdownButton = document.getElementById("dropdownButton");
const dropdownMenu = document.getElementById("dropdownMenu");

dropdownButton.addEventListener("click", () => {
    dropdownMenu.classList.toggle("hidden");
});

function showSlide(index){
    slides.forEach(s => s.style.display='none');
    slides[index].style.display='block';
}

showSlide(currentSlide);

function changeSlide(n){
    if(meniActive) return; 
    currentSlide += n;
    if(currentSlide >= slides.length) currentSlide = 0;
    if(currentSlide < 0) currentSlide = slides.length - 1;
    showSlide(currentSlide);
}

function filterSlides(category){
    meniActive = false;
    document.querySelector('.prev').style.display = "block";
    document.querySelector('.next').style.display = "block";
    let meniSlide = document.getElementById("meniSlide");
    if (meniSlide) meniSlide.remove();
    slides = Array.from(document.querySelectorAll('.slide')).filter(s => s.id !== "meniSlide").filter(s => category === 'sve' || s.dataset.category === category);
    document.querySelectorAll('.slide').forEach(s => s.style.display='none');
    currentSlide = 0;
    showSlide(0);
}

function showMeni(){
    meniActive = true;
    document.querySelectorAll('.slide').forEach(s => s.style.display='none');
    document.querySelector('.prev').style.display = "none";
    document.querySelector('.next').style.display = "none";
    if(!document.getElementById("meniSlide")){
        let div = document.createElement("div");
        div.id = "meniSlide";
        div.className = "slide";
        div.innerHTML = `
            <img src="{{ asset('images/ambijent/meni.png') }}" style="width:100%; height:auto; object-fit:contain; border-radius:15px;">
        `;
        document.getElementById("slider").appendChild(div);
    }
    document.getElementById("meniSlide").style.display = "block";
}
</script>

</body>
</html>

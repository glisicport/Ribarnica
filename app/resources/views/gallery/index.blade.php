<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Galerija</title>
<style>
body { font-family: Arial; background-color: #1e3d7a; margin:0; padding:0; }
h1 { text-align:center; margin:30px 0; color:#ffffff; font-size:2.5em; }
.filter-buttons { display:flex; justify-content:center; gap:10px; margin-bottom:20px; flex-wrap:wrap; }
.filter-buttons button { background-color:#1e3799;color:white;border:none;padding:10px 15px;border-radius:5px;cursor:pointer;transition:0.3s; }
.filter-buttons button:hover{background-color:#0a3d62;}
.back-btn{background-color:#b71540 !important;}

.slider-container { width:90%; max-width:800px; margin:0 auto; position:relative; overflow:hidden; border-radius:15px; }

.slide { display:none; width:100%; text-align:center; }
.slide img { width:100%; max-height:500px; object-fit:cover; border-radius:15px; }
.slide p { color:#ffffff; font-size:1.2em; margin-top:10px; }

.prev, .next {
    position:absolute;
    top:50%;
    transform:translateY(-50%);
    background-color:rgba(0,0,0,0.5);
    color:white;
    border:none;
    padding:10px 15px;
    cursor:pointer;
    border-radius:5px;
}
.prev { left:10px; }
.next { right:10px; }
</style>

@include('common.scripts')
</head>
<body>

@include('common.topbar')
<section class="mt-16 px-4 max-w-7xl mx-auto pb-20">
    <!-- Naslov sa premium efektom -->
    <div class="text-center mb-16 relative">
        <div class="absolute inset-0 flex items-center justify-center opacity-10">
            <div class="w-96 h-96 bg-blue-500 rounded-full blur-3xl"></div>
        </div>
        <h1 class="text-5xl md:text-7xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-cyan-500 to-blue-700 mb-4 tracking-tight relative animate-fade-in">
            Galerija
        </h1>
        <div class="flex justify-center gap-2">
            <div class="w-16 h-1.5 bg-gradient-to-r from-transparent via-blue-500 to-transparent rounded-full"></div>
            <div class="w-16 h-1.5 bg-gradient-to-r from-transparent via-cyan-400 to-transparent rounded-full"></div>
            <div class="w-16 h-1.5 bg-gradient-to-r from-transparent via-blue-500 to-transparent rounded-full"></div>
        </div>
    </div>

    <!-- Filter dugmad sa glassmorphism -->
    <div class="flex flex-wrap justify-center gap-4 mb-16">
        <button 
            onclick="filterSlides('sve')" 
            class="group relative px-8 py-3.5 bg-gradient-to-r from-blue-600 via-blue-500 to-cyan-500 text-white rounded-2xl font-bold shadow-lg shadow-blue-500/50 hover:shadow-2xl hover:shadow-blue-500/60 transition-all duration-300 hover:scale-110 active:scale-95 overflow-hidden">
            <span class="relative z-10">Sve</span>
            <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </button>
        
        <button 
            onclick="filterSlides('enterijer')" 
            class="group relative px-8 py-3.5 bg-white/90 backdrop-blur-sm text-blue-700 rounded-2xl font-bold shadow-lg shadow-blue-200/50 hover:shadow-xl hover:shadow-blue-300/60 transition-all duration-300 border-2 border-blue-200 hover:border-blue-400 hover:scale-110 active:scale-95 overflow-hidden">
            <span class="relative z-10">Enterijer</span>
            <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-cyan-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </button>
        
        <button 
            onclick="filterSlides('eksterijer')" 
            class="group relative px-8 py-3.5 bg-white/90 backdrop-blur-sm text-blue-700 rounded-2xl font-bold shadow-lg shadow-blue-200/50 hover:shadow-xl hover:shadow-blue-300/60 transition-all duration-300 border-2 border-blue-200 hover:border-blue-400 hover:scale-110 active:scale-95 overflow-hidden">
            <span class="relative z-10">Eksterijer</span>
            <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-cyan-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </button>
        
        <button 
            onclick="showMeni()" 
            class="group relative px-8 py-3.5 bg-gradient-to-r from-cyan-500 via-blue-500 to-blue-600 text-white rounded-2xl font-bold shadow-lg shadow-cyan-500/50 hover:shadow-2xl hover:shadow-cyan-500/60 transition-all duration-300 hover:scale-110 active:scale-95 overflow-hidden">
            <span class="relative z-10">Meni</span>
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-cyan-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </button>
        
        <a href="{{ url('/') }}">
            <button class="group relative px-8 py-3.5 bg-gradient-to-r from-slate-700 to-blue-900 text-white rounded-2xl font-bold shadow-lg shadow-slate-500/50 hover:shadow-2xl hover:shadow-blue-900/60 transition-all duration-300 hover:scale-110 active:scale-95 overflow-hidden">
                <span class="relative z-10 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Nazad
                </span>
                <div class="absolute inset-0 bg-gradient-to-r from-blue-900 to-slate-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </button>
        </a>
    </div>

    <!-- Slider container sa premium dizajnom -->
    <div class="relative bg-gradient-to-br from-blue-50 via-cyan-50 to-blue-100 rounded-3xl shadow-2xl overflow-hidden p-6 md:p-16 border border-blue-200/50" id="slider">
        <!-- Dekorativni elementi -->
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
                    <!-- Slika sa premium okvirom -->
                    <div class="relative w-full max-w-5xl mb-8 group">
                        <!-- Glow efekat -->
                        <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 via-cyan-500 to-blue-600 rounded-3xl blur-2xl opacity-25 group-hover:opacity-50 transition duration-500"></div>
                        
                        <!-- Slika container -->
                        <div class="relative rounded-3xl overflow-hidden shadow-2xl ring-4 ring-white/50">
                            <img 
                                src="{{ asset('images/ambijent/'.$image) }}" 
                                alt="{{ $title }}"
                                class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-110">
                            
                            <!-- Overlay gradijent -->
                            <div class="absolute inset-0 bg-gradient-to-t from-blue-900/80 via-blue-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            
                            <!-- Dekorativni uglovi -->
                            <div class="absolute top-4 left-4 w-12 h-12 border-t-4 border-l-4 border-cyan-400 rounded-tl-xl opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                            <div class="absolute bottom-4 right-4 w-12 h-12 border-b-4 border-r-4 border-cyan-400 rounded-br-xl opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                        </div>
                    </div>
                    
                    <!-- Naslov slike -->
                    <div class="relative">
                        <div class="absolute -inset-2 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-2xl blur opacity-25"></div>
                        <p class="relative text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-700 via-cyan-600 to-blue-700 text-center px-8 py-4 bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl border border-blue-200/50">
                            {{ $title }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Navigaciona dugmad - premium stil -->
        <button 
            onclick="changeSlide(-1)" 
            class="prev group absolute left-4 md:left-8 top-1/2 -translate-y-1/2 w-16 h-16 md:w-20 md:h-20 bg-white/95 backdrop-blur-md hover:bg-white text-blue-700 rounded-2xl shadow-2xl shadow-blue-900/20 hover:shadow-blue-500/40 transition-all duration-300 flex items-center justify-center text-3xl font-black hover:scale-110 active:scale-95 z-20 border-2 border-blue-200/50 hover:border-blue-400">
            <span class="group-hover:-translate-x-1 transition-transform duration-300">‹</span>
        </button>
        
        <button 
            onclick="changeSlide(1)" 
            class="next group absolute right-4 md:right-8 top-1/2 -translate-y-1/2 w-16 h-16 md:w-20 md:h-20 bg-white/95 backdrop-blur-md hover:bg-white text-blue-700 rounded-2xl shadow-2xl shadow-blue-900/20 hover:shadow-blue-500/40 transition-all duration-300 flex items-center justify-center text-3xl font-black hover:scale-110 active:scale-95 z-20 border-2 border-blue-200/50 hover:border-blue-400">
            <span class="group-hover:translate-x-1 transition-transform duration-300">›</span>
        </button>
    </div>
</section>

<style>
    .slide {
        animation: slideIn 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(30px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fade-in 1s ease-out;
    }

    /* Smooth scrolling */
    * {
        scroll-behavior: smooth;
    }
</style><script>
let currentSlide = 0;
let slides = Array.from(document.querySelectorAll('.slide'));
let meniActive = false;

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

    slides = Array.from(document.querySelectorAll('.slide'))
        .filter(s => s.id !== "meniSlide") 
        .filter(s => category === 'sve' || s.dataset.category === category);

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
            <img src="{{ asset('images/ambijent/meni.png') }}"
                 style="width:100%; height:auto; object-fit:contain; border-radius:15px;">
            <p style="color:white; font-size:1.2em;">Meni</p>
        `;

        document.getElementById("slider").appendChild(div);
    }

    document.getElementById("meniSlide").style.display = "block";
}
</script>

</body>
</html>

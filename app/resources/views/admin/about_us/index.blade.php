<link href="{{ asset('assets/css/admin/about.css') }}" rel="stylesheet" />

<div class="wrapper">

    <div class="header">
        <h2 class="title">Upravljanje sadržajem – O nama</h2>

        <button class="btn-edit-about" onclick="openAboutModal()">
            <i class="fas fa-edit"></i> Izmeni O nama
        </button>
    </div>

    <!-- PRIKAZ PODATAKA -->
    <div class="about-box">

    <!-- TITEL -->
    <h2 class="about-title">{{ $about->title }}</h2>

    <!-- SHORT DESCRIPTION -->
    <div class="about-section">
        <h4 class="section-heading">Kratak opis</h4>
        <p class="section-text">{{ $about->short_description }}</p>
    </div>

    <!-- LONG DESCRIPTION -->
    <div class="about-section">
        <h4 class="section-heading">Dugi opis</h4>
        <p class="section-text long">{{ $about->long_description }}</p>
    </div>

    <!-- MISSION -->
    <div class="about-section">
        <h4 class="section-heading">Misija</h4>
        <p class="section-text">{{ $about->mission }}</p>
    </div>

    <!-- VISION -->
    <div class="about-section">
        <h4 class="section-heading">Vizija</h4>
        <p class="section-text">{{ $about->vision }}</p>
    </div>

    <!-- IMAGE -->
    @if($about->image)
        <div class="about-image-box">
            <img src="{{ asset('storage/' . $about->image) }}" class="about-image">
        </div>
    @endif

</div>


</div>

@include('admin.about_us.aboutModal')

<script>
    window.aboutData = {
        title: @json($about->title),
        short_description: @json($about->short_description),
        long_description: @json($about->long_description),
        mission: @json($about->mission),
        vision: @json($about->vision)
    };
</script>


<script src="{{ asset('assets/js/admin/about.js') }}"></script>

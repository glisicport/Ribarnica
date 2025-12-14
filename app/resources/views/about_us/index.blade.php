<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O nama - TFZR Ribarnica</title>
    @include('common.scripts')

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;900&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #dff3ff;
            font-family: 'Roboto', sans-serif;
            color: #333;
            overflow-x: hidden;
        }

        .main-title {
            text-align: center;
            margin-top: 60px;
            font-size: 62px;
            font-weight: 900;
            font-family: 'Poppins', sans-serif;
            color: #044b8a;
            letter-spacing: 1.5px;
            opacity: 0;
            transform: translateY(-40px) scale(0.95);
            transition: 1s ease;
            text-shadow: 2px 4px 16px rgba(0,0,0,0.15);
        }
        .main-title.show {
            opacity: 1 !important;
            transform: translateY(0) scale(1) !important;
        }

        .about-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 70px 10%;
            gap: 70px;
        }

        .about-text {
            flex: 1;
            opacity: 0;
            transform: translateX(-60px);
            transition: 1s ease;
        }
        .about-text.show {
            opacity: 1;
            transform: translateX(0);
        }

        .about-text h3 {
            font-size: 34px;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            margin-bottom: 20px;
            color: #0a5ea8;
        }

        .about-text p {
            font-size: 19px;
            line-height: 1.7;
            max-width: 90%;
        }

        .about-image {
            flex: 1;
            text-align: center;
            opacity: 0;
            transform: translateX(60px);
            transition: 1s ease;
        }
        .about-image.show {
            opacity: 1;
            transform: translateX(0);
        }

        .about-image img {
            width: 100%;
            max-width: 600px;
            border-radius: 18px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.25);
        }

        .mv-wrapper {
            display: flex;
            justify-content: center;
            gap: 40px;
            padding: 60px 10%;
        }

        .mv-box {
            background: #ffffff;
            width: 45%;
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 6px 30px rgba(0,0,0,0.12);
            opacity: 0;
            transform: translateY(60px);
            transition: 1s ease;
        }
        .mv-box.show {
            opacity: 1;
            transform: translateY(0);
        }

        .mv-box h3 {
            text-align: center;
            font-size: 30px;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            margin-bottom: 20px;
            color: #0c6aad;
        }

        .mv-box p {
            font-size: 18px;
            line-height: 1.7;
            text-align: center;
        }

        .employees-title {
            text-align: center;
            margin-top: 80px;
            font-size: 48px;
            font-weight: 800;
            font-family: 'Poppins', sans-serif;
            color: #044b8a;
        }

        .employees-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
            padding: 60px 10%;
        }

        .employee-card {
            background: #fff;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 6px 26px rgba(0,0,0,0.12);
            text-align: center;
            transition: 0.4s ease;
            opacity: 0;
            transform: translateY(40px);
        }

        .employee-card.show {
            opacity: 1;
            transform: translateY(0);
        }

        .employee-card:hover {
            transform: scale(1.05);
            box-shadow: 0 14px 40px rgba(0,0,0,0.20);
        }

        .employee-photo {
            width: 100%;
            height: 260px;
            object-fit: cover;
            border-radius: 14px;
            margin-bottom: 15px;
        }

        .employee-name {
            font-size: 22px;
            font-weight: 700;
            font-family: 'Poppins';
            color: #044b8a;
        }

        .employee-position {
            font-size: 16px;
            font-weight: 600;
            color: #0b6cb9;
            margin-bottom: 10px;
        }

        .employee-bio {
            font-size: 15px;
            line-height: 1.5;
            color: #444;
        }

    </style>
</head>

<body>

@include('common.topbar')

<h1 class="main-title">{{ $about->title }}</h1>

<div class="about-wrapper">
    <div class="about-text">
        <h3>{{ $about->short_description }}</h3>
        <p>{{ $about->long_description }}</p>
    </div>

    <div class="about-image">
        <img src="{{ asset('storage/' . $about->image) }}" alt="Slika o nama">
    </div>
</div>

<div class="mv-wrapper">
    <div class="mv-box">
        <h3>Misija</h3>
        <p>{{ $about->mission }}</p>
    </div>

    <div class="mv-box">
        <h3>Vizija</h3>
        <p>{{ $about->vision }}</p>
    </div>
</div>

<h2 class="employees-title">Naš tim</h2>

<div class="employees-grid">
    @foreach($employees as $emp)
        <div class="employee-card">
            <img class="employee-photo" src="{{ asset('storage/' . $emp->photo) }}" alt="Foto zaposlenog">

            <div class="employee-name">{{ $emp->name }} {{ $emp->last_name }}</div>
            <div class="employee-position">{{ $emp->position }}</div>
            <p class="employee-bio">{{ $emp->bio }}</p>
        </div>
    @endforeach
</div>

<script>
    const elements = document.querySelectorAll(".main-title, .about-text, .about-image, .mv-box, .employee-card");

    function revealOnScroll() {
        let trigger = window.innerHeight * 0.85;

        elements.forEach(el => {
            let top = el.getBoundingClientRect().top;
            if (top < trigger) el.classList.add("show");
        });
    }

    window.addEventListener("scroll", revealOnScroll);
    window.addEventListener("load", revealOnScroll);
</script>

</body>
</html>

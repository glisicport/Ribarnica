<h1>Često postavljena pitanja</h1>

@foreach ($faqs as $faq)
    <div class="faq-item">
        <h3>{{ $faq->question }}</h3>
        <p>{{ $faq->answer }}</p>
        <hr>
    </div>
@endforeach

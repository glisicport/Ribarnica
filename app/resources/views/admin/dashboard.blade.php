@extends('admin.index')

@section('title', 'Kontrolni Panel')

@section('content')
@php
    // Koji panel je aktivan (FAQ, Quick Facts, Pitanja, Kontakt info)
    $currentPage = request()->get('page_type', 'faq');
@endphp

{{-- STATUS PORUKE --}}
@if(session('status'))
    <div class="mb-4 px-4 py-2 rounded bg-emerald-100 text-emerald-800">
        {{ session('status') }}
    </div>
@endif

{{-- NAVIGACIJA --}}
<nav class="mb-6 space-x-4">
    <a href="{{ route('kontrolni-panel', ['page_type' => 'faq']) }}"
       class="px-3 py-1 bg-sky-600 text-white rounded {{ $currentPage === 'faq' ? 'opacity-100' : 'opacity-60' }}">
        FAQ
    </a>

    <a href="{{ route('kontrolni-panel', ['page_type' => 'quick-facts']) }}"
       class="px-3 py-1 bg-sky-600 text-white rounded {{ $currentPage === 'quick-facts' ? 'opacity-100' : 'opacity-60' }}">
        Quick Facts
    </a>

    <a href="{{ route('kontrolni-panel', ['page_type' => 'questions']) }}"
       class="px-3 py-1 bg-sky-600 text-white rounded {{ $currentPage === 'questions' ? 'opacity-100' : 'opacity-60' }}">
        Pitanja korisnika
    </a>

    <a href="{{ route('kontrolni-panel', ['page_type' => 'contact_info']) }}"
       class="px-3 py-1 bg-sky-600 text-white rounded {{ $currentPage === 'contact_info' ? 'opacity-100' : 'opacity-60' }}">
        Kontakt informacije
    </a>
</nav>

{{-- SADRŽAJ PANELA --}}
<div class="bg-white rounded-xl border shadow-sm p-6">

    @if($currentPage === 'faq')
        {{-- FAQ --}}
        @include('admin.contact.partials.faq_table', [
            'items' => $items ?? []
        ])

    @elseif($currentPage === 'quick-facts')
        {{-- QUICK FACTS --}}
        @include('admin.contact.partials.quick_facts_table', [
            'items' => $items ?? []
        ])

    @elseif($currentPage === 'questions')
        {{-- PITANJA KORISNIKA --}}
        @include('admin.contact.partials.questions_table', [
            'questions' => $questions ?? []
        ])

    @elseif($currentPage === 'contact_info')
        {{-- KONTAKT INFORMACIJE --}}
        @include('admin.contact.partials.contact_info_table', [
            'items' => $items ?? []
        ])

    @else
        <p class="text-sm text-slate-500">
            Izabrani panel ne postoji.
        </p>
    @endif

</div>
@endsection

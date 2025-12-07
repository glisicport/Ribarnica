<?php
  $employees = \App\Models\Employee::orderBy('created_at','desc')->get();

$positions = \App\Models\Employee::select('position')
                ->distinct()
                ->pluck('position');

?>
<link href="{{ asset('assets/css/admin/employees.css') }}" rel="stylesheet"/>

<div class="wrapper">

    <div class="header">
        <div>
            <h2 class="title">Upravljanje Zaposlenima</h2>
            <p class="subtitle">Pregled i administracija zaposlenih u ribarnici.</p>
        </div>

        <button class="btn-add" onclick="openEmployeeModalNew()">
            <i class="fas fa-plus"></i> Dodaj Zaposlenog
        </button>
    </div>

    <!-- FILTERI -->
    <div class="filters-box">
        <form class="filters">

            <div class="filter-item">
                <label>Pretraga:</label>
                <input type="text" id="employee-search" placeholder="Pretraži po imenu...">
            </div>

            <div class="filter-item">
                <label>Pozicija:</label>
                <select id="employee-position">
                    <option value="">Sve pozicije</option>
                    @foreach($positions as $pos)
                        <option value="{{ strtolower($pos) }}">{{ $pos }}</option>
                    @endforeach
                </select>
            </div>

        </form>
    </div>

    <!-- GRID ZAPOSLENIH -->
    <div id="employees-grid" class="grid">

        @foreach($employees as $emp)
            <div class="card"
                data-name="{{ strtolower($emp->name . ' ' . $emp->last_name) }}"
                data-position="{{ strtolower($emp->position) }}">

                <img src="{{ asset('storage/' . $emp->photo) }}" class="photo">

                <div class="content">
                    <h3 class="emp-name">{{ $emp->name }} {{ $emp->last_name }}</h3>
                    <p class="emp-position">{{ $emp->position }}</p>
                    <p class="emp-bio">{{ $emp->bio }}</p>

                    <div class="actions">

                        {{-- EDIT --}}
                        <button class="btn-edit"
                                onclick="editEmployee({
                                    id: {{ $emp->id }},
                                    name: '{{ $emp->name }}',
                                    last_name: '{{ $emp->last_name }}',
                                    position: '{{ $emp->position }}',
                                    bio: '{{ str_replace(["\n", "\r"], ' ', $emp->bio) }}'
                                })">
                            <i class="fas fa-edit"></i>
                        </button>

                        {{-- DELETE --}}
                        <form action="{{ route('admin.employees.destroy', $emp->id) }}"
                              method="POST"
                              onsubmit="return confirm('Da li ste sigurni da želite da obrišete zaposlenog {{ $emp->name }}?');">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn-delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        @endforeach
    </div>

</div>

<script src="{{ asset('assets/js/admin/employees.js') }}"></script>

@include('admin.employees.employeesModal')

@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-gray-600">Patients</h2>
        <p class="text-3xl font-bold">{{ $patients_count }}</p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-gray-600">Médecins</h2>
        <p class="text-3xl font-bold">{{ $medecins_count }}</p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-gray-600">Consultations</h2>
        <p class="text-3xl font-bold">{{ $consultations_count }}</p>
    </div>

</div>

@endsection
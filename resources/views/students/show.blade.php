@extends('layouts.pronote')

@section('stats')
    <div class="pronote-stat">
        <span class="stat-value">{{ $student->grades->count() }}</span>
        <span>Notes</span>
    </div>
    <div class="pronote-stat">
        <span class="stat-value">{{ $student->grades->avg('grade') ?? 'N/A' }}</span>
        <span>Moyenne</span>
    </div>
@endsection

@section('content')
<div class="pronote-card">
    <h2>{{ $student->full_name }}</h2>
    <p><small>{{ $student->birthdate->format('d/m/Y') }}</small></p>
    
    <div class="mt-4">
        <h3>Notes</h3>
        @foreach($student->grades as $grade)
        <div class="pronote-note">
            <div class="note-value">{{ $grade->grade }}</div>
            <div class="note-date">{{ $grade->evaluation->title }} - {{ $grade->evaluation->date->format('d/m/Y') }}</div>
        </div>
        @endforeach
    </div>

    <div class="mt-4">
        <a href="{{ route('students.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Retour à la liste
        </a>
    </div>
</div>
@endsection

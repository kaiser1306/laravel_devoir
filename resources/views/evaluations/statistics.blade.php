@extends('layouts.app')

@section('title', 'Statistiques')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Statistiques générales</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="info-box bg-info">
                            <span class="info-box-icon"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Étudiants</span>
                                <span class="info-box-number">{{ $students->count() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box bg-success">
                            <span class="info-box-icon"><i class="fas fa-tasks"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Évaluations</span>
                                <span class="info-box-number">{{ $evaluations->count() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box bg-warning">
                            <span class="info-box-icon"><i class="fas fa-star"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Meilleur étudiant</span>
                                <span class="info-box-number">
                                    @php
                                        $bestStudent = $students->sortByDesc(function($student) {
                                            return $student->grades->avg('grade') ?? 0;
                                        })->first();
                                    @endphp
                                    {{ $bestStudent ? $bestStudent->full_name : 'N/A' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Moyennes par évaluation</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Évaluation</th>
                            <th>Moyenne</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($evaluations as $evaluation)
                        <tr>
                            <td>{{ $evaluation->title }}</td>
                            <td>{{ $evaluation->grades->avg('grade') ?? 'N/A' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

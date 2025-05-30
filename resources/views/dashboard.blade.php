@extends('layouts.base')

@section('title', 'Tableau de bord')

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $students_count }}</h3>
                <p>Étudiants</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ route('students.index') }}" class="small-box-footer">Plus d'info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $evaluations_count }}</h3>
                <p>Évaluations</p>
            </div>
            <div class="icon">
                <i class="fas fa-tasks"></i>
            </div>
            <a href="{{ route('evaluations.index') }}" class="small-box-footer">Plus d'info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $best_student ? $best_student->full_name . ' (' . number_format($best_student->averageGrade(), 2) . ')' : 'N/A' }}</h3>
                <p>Meilleur étudiant</p>
            </div>
            <div class="icon">
                <i class="fas fa-star"></i>
            </div>
            <a href="{{ route('evaluations.statistics') }}" class="small-box-footer">Plus d'info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
@endsection

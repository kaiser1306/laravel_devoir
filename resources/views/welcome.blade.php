@extends('layouts.adminlte')

@section('title', 'Bienvenue')
@section('icon', 'home')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Bienvenue</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h2>Bienvenue sur votre application Laravel</h2>
                            <p>Votre application est prête à être utilisée !</p>
                            
                            @if($students_count > 0)
                                <div class="row mt-4">
                                    <div class="col-md-4">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-info">
                                                <i class="fas fa-users"></i>
                                            </span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Étudiants</span>
                                                <span class="info-box-number">{{ $students_count }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-success">
                                                <i class="fas fa-clipboard-check"></i>
                                            </span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Évaluations</span>
                                                <span class="info-box-number">{{ $evaluations_count }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @if($best_student)
                                    <div class="col-md-4">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-warning">
                                                <i class="fas fa-star"></i>
                                            </span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Meilleur étudiant</span>
                                                <span class="info-box-number">{{ $best_student->name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
                    <div class="card">
                        <div class="card-body">
                            <h2>Bienvenue sur votre application Laravel</h2>
                            <p>Votre application est prête à être utilisée !</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
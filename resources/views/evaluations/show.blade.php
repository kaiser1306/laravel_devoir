@extends('layouts.app')

@section('title', 'Notes de l\'évaluation')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Notes - {{ $evaluation->title }}</h3>
        <div class="card-tools">
            <a href="{{ route('evaluations.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-3">
                <strong>Date :</strong> {{ $evaluation->date->format('d/m/Y') }}
            </div>
            <div class="col-md-3">
                <strong>Type :</strong> {{ ucfirst($evaluation->type) }}
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Ajouter une note</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('grades.store', $evaluation) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="student_id">Étudiant</label>
                                <select name="student_id" id="student_id" class="form-control @error('student_id') is-invalid @enderror" required>
                                    @foreach($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->full_name }}</option>
                                    @endforeach
                                </select>
                                @error('student_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="grade">Note</label>
                                <input type="number" step="0.01" min="0" max="20" name="grade" id="grade" class="form-control @error('grade') is-invalid @enderror" required>
                                @error('grade')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Ajouter la note</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Liste des notes</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Étudiant</th>
                                    <th>Note</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($grades as $grade)
                                <tr>
                                    <td>{{ $grade->student->full_name }}</td>
                                    <td>{{ $grade->grade }}</td>
                                    <td>
                                        <form action="{{ route('grades.destroy', $grade) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

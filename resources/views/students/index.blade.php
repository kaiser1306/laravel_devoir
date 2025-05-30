@extends('layouts.adminlte')

@section('title', 'Liste des étudiants')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <student-list title="Liste des étudiants"></student-list>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ mix('js/app.js') }}"></script>
@endpush
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nom complet</th>
                    <th>Date de naissance</th>
                    <th>Moyenne</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td>{{ $student->full_name }}</td>
                    <td>{{ $student->birthdate->format('d/m/Y') }}</td>
                    <td>
                        <span class="pronote-grade">
                            {{ $student->grades->avg('grade') ?? 'N/A' }}
                        </span>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr ?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

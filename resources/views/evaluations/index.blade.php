@extends('layouts.adminlte')

@section('title', 'Liste des évaluations')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <evaluation-list title="Liste des évaluations"></evaluation-list>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ mix('js/app.js') }}"></script>
@endpush

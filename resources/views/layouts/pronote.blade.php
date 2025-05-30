<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/admin-lte/css/adminlte.min.css') }}" rel="stylesheet">
    <style>
        .pronote-header {
            background-color: #003366;
            color: white;
            padding: 1rem;
            margin-bottom: 2rem;
        }
        .pronote-header h1 {
            margin: 0;
            font-size: 1.5rem;
        }
        .pronote-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 1rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .pronote-grade {
            font-size: 1.5rem;
            font-weight: bold;
            color: #003366;
        }
        .pronote-note {
            background: #f8f9fa;
            padding: 0.5rem;
            border-radius: 4px;
            margin: 0.5rem 0;
        }
        .pronote-note .note-value {
            font-size: 1.2rem;
            font-weight: bold;
            color: #003366;
        }
        .pronote-note .note-date {
            font-size: 0.9rem;
            color: #666;
        }
        .pronote-stat {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: #f0f8ff;
            border-radius: 4px;
            margin-right: 1rem;
        }
        .pronote-stat .stat-value {
            font-weight: bold;
            color: #003366;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="pronote-header">
            <h1>Gestion des Évaluations</h1>
            <div class="pronote-stats">
                @yield('stats')
            </div>
        </div>
        
        @yield('content')
    </div>

    <script src="{{ asset('vendor/admin-lte/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvaluationController extends Controller
{
    public function index()
    {
        return Evaluation::with(['grades'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'type' => 'required|in:examen,devoir,tp'
        ]);

        $evaluation = Evaluation::create($validated);
        return $evaluation;
    }

    public function update(Request $request, Evaluation $evaluation)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'type' => 'required|in:examen,devoir,tp'
        ]);

        $evaluation->update($validated);
        return $evaluation;
    }

    public function destroy(Evaluation $evaluation)
    {
        $evaluation->delete();
        return response()->noContent();
    }

    public function statistics()
    {
        $stats = [
            'total_evaluations' => Evaluation::count(),
            'average_grade' => DB::table('grades')
                ->select(DB::raw('AVG(grade) as average'))
                ->first()
                ->average ?? 0,
            'by_type' => Evaluation::select('type', DB::raw('COUNT(*) as count'))
                ->groupBy('type')
                ->get()
                ->pluck('count', 'type')
                ->toArray()
        ];

        return $stats;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function index()
    {
        $evaluations = Evaluation::with('grades.student')->get();
        return view('evaluations.index', compact('evaluations'));
    }

    public function create()
    {
        return view('evaluations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:45',
            'date' => 'required|date',
            'type' => 'required|in:exam,homework'
        ]);

        Evaluation::create($validated);
        return redirect()->route('evaluations.index')->with('success', 'Évaluation créée avec succès');
    }

    public function show(Evaluation $evaluation)
    {
        $students = Student::all();
        $grades = $evaluation->grades;
        return view('evaluations.show', compact('evaluation', 'students', 'grades'));
    }

    public function storeGrade(Request $request, Evaluation $evaluation)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'grade' => 'required|numeric|min:0|max:20'
        ]);

        Grade::create([
            'student_id' => $validated['student_id'],
            'evaluation_id' => $evaluation->id,
            'grade' => $validated['grade']
        ]);

        return redirect()->route('evaluations.show', $evaluation)->with('success', 'Note enregistrée avec succès');
    }

    public function statistics()
    {
        $students = Student::with('grades.evaluation')->get();
        $evaluations = Evaluation::with('grades.student')->get();

        return view('evaluations.statistics', compact('students', 'evaluations'));
    }

    public function edit(Evaluation $evaluation)
    {
        return view('evaluations.edit', compact('evaluation'));
    }

    public function update(Request $request, Evaluation $evaluation)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:45',
            'date' => 'required|date',
            'type' => 'required|in:exam,homework'
        ]);

        $evaluation->update($validated);
        return redirect()->route('evaluations.index')->with('success', 'Évaluation mise à jour avec succès');
    }

    public function destroy(Evaluation $evaluation)
    {
        $evaluation->delete();
        return redirect()->route('evaluations.index')->with('success', 'Évaluation supprimée avec succès');
    }
}

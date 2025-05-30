<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Evaluation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $students_count = Student::count();
        $evaluations_count = Evaluation::count();
        
        // Trouver le meilleur étudiant
        $best_student = Student::with('grades')
            ->withAvg('grades', 'grade')
            ->orderByDesc('grades_avg_grade')
            ->first();

        return view('welcome', compact('students_count', 'evaluations_count', 'best_student'));
    }
}

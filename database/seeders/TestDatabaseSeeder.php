<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Evaluation;
use App\Models\Grade;

class TestDatabaseSeeder extends Seeder
{
    public function run()
    {
        // Créer quelques étudiants
        $students = Student::factory()->count(3)->create();

        // Créer quelques évaluations
        $evaluations = Evaluation::factory()->count(2)->create();

        // Créer des notes aléatoires
        foreach ($evaluations as $evaluation) {
            foreach ($students as $student) {
                Grade::create([
                    'student_id' => $student->id,
                    'evaluation_id' => $evaluation->id,
                    'grade' => rand(10, 20) / 2
                ]);
            }
        }
    }
}

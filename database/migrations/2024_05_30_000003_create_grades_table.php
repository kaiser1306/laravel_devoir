<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('evaluation_id')->constrained('evaluations')->onDelete('cascade');
            $table->decimal('grade', 5, 2);
            $table->timestamps();
        });

        // Créer un index pour optimiser les jointures
        Schema::table('grades', function (Blueprint $table) {
            $table->index(['student_id', 'evaluation_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('grades');
    }
};

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
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('evaluation_id')->constrained()->onDelete('cascade');
            $table->decimal('grade', 5, 2);
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->unique(['student_id', 'evaluation_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('grades');
    }
};

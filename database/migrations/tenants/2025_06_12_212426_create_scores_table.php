<?php
namespace Database\migrations\tenants;


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained('exams', 'id');
            $table->foreignId('student_id')->constrained('students', 'id');
            $table->foreignId('subject_id')->constrained('subjects', 'id');
            $table->foreignId('class_id')->constrained('school_classes', 'id');
            $table->decimal('score', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};

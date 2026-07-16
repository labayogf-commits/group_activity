<?php

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
    Schema::create('students', function (Blueprint $table) {
        $table->id();
        $table->string('student_id')->unique(); // For '101'
        $table->string('name');                // For 'Ma Romualdo'
        $table->string('course');              // For 'bscs'
        $table->integer('year');               // For '3'
        $table->string('email')->unique();     // For 'dianromualdo19@gmail.com'
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

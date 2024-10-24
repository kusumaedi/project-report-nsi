<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained();
            $table->integer('section_id');
            $table->string('shift', 50)->nullable();
            $table->timestamp('report_at')->nullable();
            $table->string('title');
            $table->json('potential_dangerous_point');
            $table->json('most_danger_point');
            $table->longtext('statement');
            $table->longtext('keyword');
            $table->json('instructor');
            $table->json('attendant');
            $table->string('checker');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
};

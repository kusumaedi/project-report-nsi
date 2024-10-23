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
            $table->integer('team_id');
            $table->string('shift', 50)->nullable();
            $table->timestamp('report_at')->nullable();
            $table->string('title');
            $table->longtext('potential_dangerous_point');
            $table->longtext('most_danger_point');
            $table->longtext('statement');
            $table->longtext('keyword');
            $table->json('instructor');
            $table->json('attendant');
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

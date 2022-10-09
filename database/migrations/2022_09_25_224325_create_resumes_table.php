<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('targetJob');
            $table->string('careerLevel')->default('None');
            $table->string('country');
            $table->string('phoneNumber');
            $table->text('about');
            $table->longText('content')->nullable();
            $table->timestamps();
        });

        DB::statement('ALTER TABLE resumes ADD CONSTRAINT check_careerLevel CHECK (careerLevel in ("Student/Internship","Entry Level","Mid Career","Management","Head","Senior Executive"));');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resumes');
    }
};

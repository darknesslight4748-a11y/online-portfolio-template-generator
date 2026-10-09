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
    Schema::create('portfolios', function (Blueprint $table) {
        $table->id();

        $table->string('full_name');
        $table->string('profile_picture')->nullable();
        $table->string('email');
        $table->string('contact_number')->nullable();
        $table->text('address')->nullable();
        $table->text('about_me')->nullable();
        $table->text('education')->nullable();
        $table->text('skills')->nullable();
        $table->text('projects')->nullable();
        $table->text('work_experience')->nullable();
        $table->text('social_links')->nullable();

        $table->string('template')->default('template1');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};

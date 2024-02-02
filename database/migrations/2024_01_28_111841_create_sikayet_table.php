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
        Schema::create('sikayet', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sikayetci')->index();
            $table->foreignId('operator_id');
            $table->string('movzu',300);
            $table->text('metn');
            $table->tinyText('fayllar');
            $table->timestamps();

        });

        Schema::table('sikayet', function (Blueprint $table) {
            $table->foreign('sikayetci')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sikayet');
    }
};

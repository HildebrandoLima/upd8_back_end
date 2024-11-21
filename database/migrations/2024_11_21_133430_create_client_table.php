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
        Schema::create('client', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name', 255)->unique()->notnull();
            $table->char('cpf', 14)->unique()->notnull();
            $table->enum('sex', ['M', 'F']);
            $table->string('address', 255)->notnull();
            $table->date('date_birth')->notnull();
            $table->foreignId('city_id')->constrained('city')->notnull();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client');
    }
};

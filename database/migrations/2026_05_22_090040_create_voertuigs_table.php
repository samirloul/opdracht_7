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
        Schema::create('voertuigs', function (Blueprint $table) {
            $table->id();
            $table->string('kenteken', 15)->unique();
            $table->string('type', 120);
            $table->date('bouwjaar');
            $table->string('brandstof', 20);
            $table->foreignId('type_voertuig_id')->constrained('type_voertuigs');
            $table->boolean('is_actief')->default(true);
            $table->string('opmerking', 250)->nullable();
            $table->dateTime('datum_aangemaakt', 6);
            $table->dateTime('datum_gewijzigd', 6);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voertuigs');
    }
};

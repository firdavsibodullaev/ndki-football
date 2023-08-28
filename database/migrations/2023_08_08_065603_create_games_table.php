<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('season_id')->constrained()->cascadeOnDelete();
            $table->foreignId('home_id')->constrained('season_teams')->cascadeOnDelete();
            $table->foreignId('away_id')->constrained('season_teams')->cascadeOnDelete();
            $table->timestamp('game_at');
            $table->integer('round');
            $table->boolean('is_played')->default(false);
            $table->unsignedInteger('home_goals')->default(0);
            $table->unsignedInteger('away_goals')->default(0);
            $table->timestamps();

            $table->unique(['season_id', 'home_id', 'away_id', 'round']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};

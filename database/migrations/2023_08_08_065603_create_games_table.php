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
            $table->foreignId('team_1')->constrained('teams')->cascadeOnDelete();
            $table->foreignId('team_2')->constrained('teams')->cascadeOnDelete();
            $table->timestamp('game_at')->nullable();
            $table->unsignedInteger('team_1_goals')->default(0);
            $table->unsignedInteger('team_2_goals')->default(0);
            $table->timestamps();

            $table->index('season_id', 'team_1', 'team_2');
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

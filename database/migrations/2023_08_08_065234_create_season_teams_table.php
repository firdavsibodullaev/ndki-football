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
        Schema::create('season_teams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('season_id')->constrained()->cascadeOnDelete();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->integer('points')->default(0);
            $table->integer('goals_scored')->default(0)->comment('Забитые голы');
            $table->integer('goals_conceded')->default(0)->comment('Пропущенные голы');
            $table->unsignedTinyInteger('victory')->default(0);
            $table->unsignedTinyInteger('defeat')->default(0);
            $table->unsignedTinyInteger('draw')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('season_teams');
    }
};

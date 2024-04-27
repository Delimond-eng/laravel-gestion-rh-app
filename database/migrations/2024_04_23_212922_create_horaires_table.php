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
        Schema::create('horaires', function (Blueprint $table) {
            $table->id();
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->time('heure_retard');
            $table->integer('nbre_retard_notification')->nullable();
            $table->unsignedBigInteger('direction_id');
            $table->unsignedBigInteger('secretariat_id');
            $table->unsignedBigInteger('ministere_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('date_creation')->useCurrent();
            $table->string('horaire_status')->default('actif');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horaires');
    }
};

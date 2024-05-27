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
        Schema::create('conges', function (Blueprint $table) {
            $table->id();
            $table->timestamp('conge_date_debut')->nullable();
            $table->timestamp('conge_date_fin')->nullable();
            $table->integer('nb_jours');
            $table->string('conge_motif')->nullable();
            $table->string('status')->default('actif');
            $table->unsignedBigInteger('agent_id');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('conge_date_creation')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conges');
    }
};

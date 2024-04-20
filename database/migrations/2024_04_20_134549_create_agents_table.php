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
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('agent_matricule')->unique();
            $table->string('agent_nom');
            $table->string('agent_postnom');
            $table->string('agent_prenom');
            $table->string('agent_genre');
            $table->string('agent_telephone');
            $table->string('agent_email');
            $table->string('agent_adresse');
            $table->string('agent_status')->default('actif');
            $table->timestamp('agent_date_creation')->useCurrent();
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('bureau_id');
            $table->unsignedBigInteger('fonction_id');
            $table->unsignedBigInteger('grade_id');
            $table->unsignedBigInteger('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents');
    }
};

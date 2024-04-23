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
        Schema::create('rotations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('equipe_id');
            $table->unsignedBigInteger('agent_id');
            $table->unsignedBigInteger('direction_id');
            $table->unsignedBigInteger('ministere_id');
            $table->unsignedBigInteger('user_id');
            $table->string('jours');
            $table->string('rotation_status')->default("actif");
            $table->timestamp("date_creation")->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rotations');
    }
};

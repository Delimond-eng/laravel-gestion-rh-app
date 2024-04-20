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
        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            $table->timestamp('presence_date')->useCurrent();
            $table->time('presence_heure_arrive')->useCurrent();
            $table->time('presence_heure_depart')->nullable();
            $table->string('presence_status')->default('present');
            $table->unsignedBigInteger('agent_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presences');
    }
};

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
        Schema::create('conge_types', function (Blueprint $table) {
            $table->id();
            $table->string('conge_type_libelle')->unique();
            $table->string('conge_type_description');
            $table->string('conge_type_status')->default('actif');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('conge_type_date_creation')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conge_types');
    }
};

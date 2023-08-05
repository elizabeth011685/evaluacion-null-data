<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados_skills', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("id_usuario")->unsigned();
            $table->string("skill");
            $table->integer("evaluacion");
            $table->timestamps();

            $table->foreign("id_usuario")->references("id")->on("empleados");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados_skills');
    }
}

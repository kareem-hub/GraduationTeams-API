<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('leader_id', 20)->unique();
            $table->foreign('leader_id')->references('username')->on('leaders')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->text('needs');
        });

        /* Schema::create('teams', function (Blueprint $table) {
            $table->string('leader_id', 20)->unique();
            $table->foreign('leader_id')->references('phone')->on('leaders')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->text('needs');
        }); */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}

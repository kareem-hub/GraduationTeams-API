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
        Schema::create('members', function (Blueprint $table) {
            $table->unsignedInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('name', 30);
            $table->string('department', 5);
            $table->string('major', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
};

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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('machine_id')->nullable(false);
            $table->string('partNumber')->nullable(false);
            $table->integer('count')->default(0);
            $table->integer('currentCount')->default(0);
            $table->date('date')->nullable(false);
            $table->boolean('completed')->default(false);
            $table->boolean('inWork')->default(false);
            $table->date('dateCompleted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};

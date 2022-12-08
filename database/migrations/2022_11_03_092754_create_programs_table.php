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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('partNumber')->nullable(false);
            $table->integer('machine_id')->nullable(false);
            $table->integer('user_id')->nullable(false);
            $table->integer('partType_id')->nullable(false);
            $table->integer('material_id')->nullable(false);
            $table->enum('materialType', ['hexagon', 'round', 'tube', 'square'])->nullable(false);
            $table->string('title_1')->nullable();
            $table->string('title_2')->nullable();
            $table->text('text_1')->nullable();
            $table->text('text_2')->nullable();
            $table->string('partPhoto')->nullable();
            $table->integer('materialDiameter')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('programs');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('tabNumber')->nullable(false);
            $table->enum('shift_id', ['1', '2'])->default('1');
            $table->string('avatar')->nullable();
            $table->integer('position_id')->nullable();
            $table->date('employmentDate')->nullable();
            $table->enum('status', ['WORKS', 'FIRED'])->nullable();
            $table->enum('role', ['USER', 'ADMIN', 'SERVICE', 'GUEST'])->default('USER');
            $table->index('tabNumber');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
                //
        });
    }
};

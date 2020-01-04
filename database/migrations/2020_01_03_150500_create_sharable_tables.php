<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSharableTables extends Migration
{
    public function up()
    {
        $tableNames = config('sharable.table_names');

        Schema::create($tableNames['sharings'], function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('sharable');
            $table->unsignedInteger('allows');
            $table->string('token')->unique();
            $table->timestamps();
        });

        Schema::create($tableNames['model_has_collaborators'], function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('sharing_id')->nullable();
            $table->foreign('sharing_id')
                  ->references('id')
                  ->on('shares')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('user_id');
            $table->morphs('model');
            $table->timestamps();
        });
    }

    public function down()
    {
        $tableNames = config('sharable.table_names');

        Schema::dropIfExists($tableNames['model_has_collaborators']);
        Schema::dropIfExists($tableNames['sharings']);
    }
}

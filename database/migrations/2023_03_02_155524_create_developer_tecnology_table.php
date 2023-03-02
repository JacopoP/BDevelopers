<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('developer_tecnology', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('technology_id');
            $table->bigInteger('developer_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('developer_tecnology');
    }
};

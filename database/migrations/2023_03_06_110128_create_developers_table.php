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
        Schema::create('developers', function (Blueprint $table) {
            $table->id();
            $table -> string('address') -> nullable(true);
            $table -> string('phone_number', 32) -> nullable(true);
            $table -> string('profile_path') -> nullable(true);
            $table -> string('cv_path') -> nullable(true);
            $table -> string('portfolio_url') -> nullable(true);
            $table -> text('about_me') -> nullable(true);
            $table -> text('performances') -> nullable(true);
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
        Schema::dropIfExists('developers');
    }
};

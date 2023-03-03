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
        Schema::table('developers', function (Blueprint $table) {

            $table->foreignId('user_id')->primary()->constrained();
        });
        Schema::table('developer_technology', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('developers');
            $table->foreignId('technology_id')->constrained();
        });
        Schema::table('developer_sponsor', function (Blueprint $table) {

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('developers');;
            $table->foreignId('sponsor_id')->constrained();
        });
        Schema::table('messages', function (Blueprint $table) {

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('developers');;
        });
        Schema::table('reviews', function (Blueprint $table) {

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('developers');;
        });
        Schema::table('developer_rating', function (Blueprint $table) {

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('developers');;
            $table->foreignId('rating_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('developers', function (Blueprint $table) {

            $table->dropForeign('developers_user_id_foreign');
        });
        Schema::table('developer_technology', function (Blueprint $table) {

            $table->dropForeign('developer_technology_user_id_foreign');
            $table->dropForeign('developer_technology_technology_id_foreign');
        });
        Schema::table('developer_sponsor', function (Blueprint $table) {

            $table->dropForeign('developer_sponsor_user_id_foreign');
            $table->dropForeign('developer_sponsor_sponsor_id_foreign');
        });
        Schema::table('messages', function (Blueprint $table) {

            $table->dropForeign('messages_user_id_foreign');
        });
        Schema::table('reviews', function (Blueprint $table) {

            $table->dropForeign('reviews_user_id_foreign');
        });
        Schema::table('developer_rating', function (Blueprint $table) {

            $table->dropForeign('developer_rating_user_id_foreign');
            $table->dropForeign('developer_rating_rating_id_foreign');
        });
    }
};

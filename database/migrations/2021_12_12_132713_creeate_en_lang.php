<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreeateEnLang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name_en')->nullable();
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->string('name_en')->nullable();
        });

        Schema::table('skills', function (Blueprint $table) {
            $table->string('name_en')->nullable();
        });

        Schema::table('sources', function (Blueprint $table) {
            $table->string('name_en')->nullable();
        });

        Schema::table('statuses', function (Blueprint $table) {
            $table->string('name_en')->nullable();
        });

        Schema::table('workers', function (Blueprint $table) {
            $table->string('sex_en')->nullable();
            $table->string('region_en')->nullable();
            $table->string('education_en')->nullable();
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
            $table->dropColumn(['name_en']);
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn(['name_en']);
        });

        Schema::table('skills', function (Blueprint $table) {
            $table->dropColumn(['name_en']);
        });

        Schema::table('sources', function (Blueprint $table) {
            $table->dropColumn(['name_en']);
        });

        Schema::table('statuses', function (Blueprint $table) {
            $table->dropColumn(['name_en']);
        });

        Schema::table('workers', function (Blueprint $table) {
            $table->dropColumn(['sex_en', 'region_en', 'education_en']);
        });
    }
}

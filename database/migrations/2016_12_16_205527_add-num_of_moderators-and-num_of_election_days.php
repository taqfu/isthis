<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNumOfModeratorsAndNumOfElectionDays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mobs', function (Blueprint $table) {
            $table->integer('num_of_moderators')->unsigned()->default(1);
            $table->integer('num_of_election_days')->unsigned()->default(7);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mobs', function (Blueprint $table) {
            //
        });
    }
}

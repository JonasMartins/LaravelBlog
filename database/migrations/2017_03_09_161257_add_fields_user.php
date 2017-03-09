<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('users', function (Blueprint $table) {
            /* informações importantes para que o admin possa vê-las */
            $table->smallInteger('level_id')->nullable()->unsigned();
            $table->text('bio')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('phone')->nullable();
            /* para evitar a criação de um model level_users */
            $table->foreign('level_id')->references('id')->on('user_levels');
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
            $table->dropColumn('level_id');
            $table->dropColumn('bio');
            $table->dropColumn('birth_date');
            $table->dropColumn('phone');
        });
    }
}

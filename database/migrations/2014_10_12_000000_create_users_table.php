<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Schema::create('users', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('facebook_id')->unique;
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('app_token');
            $table->string('avatar');
            $table->rememberToken();
            $table->timestamps();
        });
            */
            Schema::table( 'users', function($table)
            {
                $table->string( 'app_token' )->after( 'password' )->nullable();
            });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}

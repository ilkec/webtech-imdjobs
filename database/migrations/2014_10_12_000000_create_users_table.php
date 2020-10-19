<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->longText('description')->nullable();
            $table->string('picture',300)->nullable();
            $table->string('phone_number',300)->nullable();
            $table->string('city',300)->nullable();
            $table->date('birthday')->nullable();
            $table->string('dribbble')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('behance')->nullable();
            $table->string('github')->nullable();
            $table->string('website')->nullable();
            $table->string('cv')->nullable();
            $table->boolean('account_type');
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

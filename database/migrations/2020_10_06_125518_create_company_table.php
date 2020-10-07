<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 300);
            $table->longText('description');
            $table->string('picture', 300)->nullable();
            $table->string('email', 300)->unique();
            $table->string('phone_number', 300);
            $table->string('province', 300);
            $table->string('street_name', 300);
            $table->integer('number');
            $table->string('city', 300);
            $table->string('postal_code', 300);
            $table->foreignId('users_id')->constrained('users'); /*which user made this company profile*/
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
        Schema::dropIfExists('companies');
    }
}

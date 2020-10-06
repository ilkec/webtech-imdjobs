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
        Schema::create('tl_company', function (Blueprint $table) {
            $table->id();
            $table->string('name',300);
            $table->longText('description');
            $table->string('email',300);
            $table->string('province',300);
            $table->string('street_name',300);
            $table->integer('number');
            $table->string('city',300);
            $table->string('postal_code',300);
            $table->string('phone_number',300);
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
        Schema::dropIfExists('tl_company');
    }
}

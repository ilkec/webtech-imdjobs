<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Boolean;

class CreateInternshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internships', function (Blueprint $table) {
            $table->id();
            $table->string('title',300);
            $table->string('postal_code',300);
            $table->string('city',300);
            $table->longText('description');
            $table->longText('tasks');
            $table->longText('profile');
            $table->boolean('active');
            $table->foreignId('company_id')->constrained('company');
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
        Schema::dropIfExists('tl_internships');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tl_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('internship_title', 300);
            $table->longText('review');
            $table->integer('score');
            $table->boolean('mentoring');
            $table->foreignId('users_id')->constrained('tl_users');
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
        Schema::dropIfExists('tl_reviews');
    }
}

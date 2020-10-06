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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('internship_title', 300);
            $table->longText('review');
            $table->integer('score');
            $table->boolean('mentoring');
            $table->foreignId('users_id')->constrained('users'); /* which user added the review*/
            $table->foreignId('company_id')->constrained('company'); /* which company is the review about*/
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

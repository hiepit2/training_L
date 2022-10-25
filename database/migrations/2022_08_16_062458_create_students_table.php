<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('email')->unique();
            $table->string('avatar');
            $table->string('phone');
            $table->date('birthday');
            $table->string('address');
            $table->string('code');
            $table->unsignedTinyInteger('gender');
            $table->unsignedTinyInteger('status');
            $table->unsignedBigInteger('faculty_id')->unsigned()->nullable();
            $table->foreign('faculty_id')
                ->references('id')
                ->on('faculties')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->softDeletes();
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
        Schema::dropIfExists('students');
    }
};

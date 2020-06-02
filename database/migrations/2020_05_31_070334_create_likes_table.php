<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('likeable_id');
            $table->string('likeable_type', 25);

            $table->unique(['user_id', 'likeable_id', 'likeable_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('likes');
    }
}

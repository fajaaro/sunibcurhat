<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDislikesTable extends Migration
{
    public function up()
    {
        Schema::create('dislikes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('dislikeable_id');
            $table->string('dislikeable_type', 25);

            $table->unique(['user_id', 'dislikeable_id', 'dislikeable_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('dislikes');
    }
}

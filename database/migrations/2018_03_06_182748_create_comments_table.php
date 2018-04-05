<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('comments',function(Blueprint $table){
            $table->increments('id');
            $table->string('body');
            $table->string('url')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('commentable_id')->unsigned();
            
            $table->string('commentable_type,255');
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps('created_at');
        });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('comments');
    }
}

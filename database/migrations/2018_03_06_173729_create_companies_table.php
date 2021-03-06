<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('companies',function(Blueprint $table){
            $table->increments('id');
            $table->longText('description');
            $table->string('name');
            $table->integer('user_id')->unsigned();
            $table->string('code');
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
        Schema::dropIfExists('companies');
    }
}

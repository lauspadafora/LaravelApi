<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class CreateFrecuenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frecuencias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');            
            $table->timestamps();
            $table->softDeletes();            
            $table->integer('created_by')->unsigned()->nullable();
            $table->foreign('created_by')
                   ->references('id')->on('users')
                   ->onDelete('cascade');                   
            $table->integer('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')
                   ->references('id')->on('users')
                   ->onDelete('cascade');            
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->foreign('deleted_by')
                   ->references('id')->on('users')
                   ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('frecuencias');
    }
}

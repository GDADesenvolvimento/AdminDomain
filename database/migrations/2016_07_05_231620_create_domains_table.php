<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('client');
            $table->string('nome');
            $table->string('dominio');
            $table->date('data_registro');
            $table->date('data_vencimento');
            $table->string('orgao_registro');
            $table->double('valor', 10, 2);
            $table->string('status');
            $table->string('descricao');
            $table->boolean('publicado')->nullable();
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
        Schema::drop('domains');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnoncesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('annonces', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('utilisateur_id')->references('id')->on('utilisateurs');
			$table->string('title');
			$table->string('describe');
			$table->float('price');
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
		Schema::drop('annonces');
	}

}

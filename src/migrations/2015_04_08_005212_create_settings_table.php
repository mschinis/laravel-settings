<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::create(Config::get('settings::table'),function(Blueprint $table){
			$table->increments('id');
			$table->string('key')->unique();
			$table->string('value');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		Schema::drop(Config::get('settings::table'));
	}

}

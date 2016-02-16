<?php

use Illuminate\Database\Seeder;

class OAuthClientSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		for ($i=1; $i <= 10 ; $i++)
		{
			DB::table('oauth_clients')->insert(
			[
				'id' => $i,
				'secret' => "secret$i",
				'name' => "cliente$i"
			]);
		}
	}

}

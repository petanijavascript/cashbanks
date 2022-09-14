<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
        
        App\User::create([
            'Username' => 'admin',
            'password' => Hash::make('admin'),
            'firstname' => 'super',
            'lastname' => 'admin',
            'email' => 'admin@admin.com',
            'groupid' => 1,
            'isActiveRecord' => 1
        ]);

		// $this->call('nama seeder nya');
        
        //blabla::truncate();
        
        //contoh
//        // TABLE KECAMATAN
//        DB::table('kecamatan')->insert(array(
//            array('kecamatan' => 'Picung', 'kota_id' => 1),
//            array('kecamatan' => 'Munjul', 'kota_id' => 1),
//            array('kecamatan' => 'Cikeusal', 'kota_id' => 2),
//            array('kecamatan' => 'Curug', 'kota_id' => 2)
//        ));
	}

}

<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
        $this->call('OptionsTableSeeder');
	}
}


class OptionsTableSeeder extends Seeder
{

	public function run()
	{
      DB::table('options')->delete();
      
      Option::create(
        array(
          'opt'   => 'zacatek_registrace',
          'name'  => 'Začátek registrace',
          'value' => '2014-10-27 12:00:00'
        )
      );
      
      Option::create(
        array(
          'opt'   => 'konec_registrace',
          'name'  => 'Konec registrace',
          'value' => '2014-11-21 12:00:00'
        )
      );

      Option::create(
        array(
          'opt'   => 'kapacita',
          'name'  => 'Kapacita',
          'value' => '400'
        )
      );
      
      Option::create(
        array(
          'opt'   => 'kapacita_s1',
          'name'  => 'Kapacita Sekce nejen pro nové starosty',
          'value' => '30'
        )
      );
      
      Option::create(
        array(
          'opt'   => 'kapacita_s2',
          'name'  => 'Kapacita Sekce pro školy',
          'value' => '10'
        )
      );
            
      Option::create(
        array(
          'opt'   => 'kapacita_s3',
          'name'  => 'Kapacita Sekce Problematika Integrovaných teritoriálních investic pro poradenské agentury',
          'value' => '40'
        )
      );
	}	
}
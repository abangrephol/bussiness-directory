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

        $this->call('CountriesTableSeeder');
        $this->command->info('Seeded the countries!');
        $this->call('StatesTableSeeder');
        $this->command->info('Seeded the states!');
        $this->call('CategoriesTableSeeder');
        $this->command->info('Seeded the categories!');
    }

}

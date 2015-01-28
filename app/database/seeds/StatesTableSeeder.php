<?php

class StatesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('states')->delete();
        $states = array(
            array('country_id'=>189,'name'=>'Kuala Lumpur'),
            array('country_id'=>189,'name'=>'Johor'),
            array('country_id'=>189,'name'=>'Kedah'),
            array('country_id'=>189,'name'=>'Kelantan'),
            array('country_id'=>189,'name'=>'Malacca'),
            array('country_id'=>189,'name'=>'Negeri Sembilan'),
            array('country_id'=>189,'name'=>'Pahang'),
            array('country_id'=>189,'name'=>'Penang'),
            array('country_id'=>189,'name'=>'Perak'),
            array('country_id'=>189,'name'=>'Perlis'),
            array('country_id'=>189,'name'=>'Putrajaya'),
            array('country_id'=>189,'name'=>'Sabah'),
            array('country_id'=>189,'name'=>'Sarawak'),
            array('country_id'=>189,'name'=>'Selangor'),
            array('country_id'=>189,'name'=>'Terengganu'),
        );
        DB::table('states')->insert($states);
    }
}
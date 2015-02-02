<?php


class CategoriesTableSeeder extends Seeder {

	public function run()
	{
        DB::table('categories')->delete();
        $data = array(
            ['name'=>'Accommodation & Travel'],
            ['name'=>'Agriculture'],
            ['name'=>'Apparel, Clothing & Fashion'],
            ['name'=>'Automotive'],
            ['name'=>'Business Services'],
            ['name'=>'Computers & Information Technology'],
            ['name'=>'Construction, Decoration & Furnishing'],
            ['name'=>'Education'],
            ['name'=>'Electronics & Electrical Appliances'],
            ['name'=>'Food & Beverage'],
            ['name'=>'Hardware, Machinery & Equipment'],
            ['name'=>'Health & Beauty'],
            ['name'=>'Industrial'],
            ['name'=>'Office Equipment & Supplies'],
            ['name'=>'Premium Goods & Gift'],
            ['name'=>'Printing, Media & Packing'],
            ['name'=>'Sports, Recreation & Entertainment'],
            ['name'=>'Transportation & Logistics'],
            ['name'=>'Other Suppliers'],
        );
        foreach($data as $d){
            \Category::create($d);
        }

	}

}
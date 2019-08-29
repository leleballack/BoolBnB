<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker; 
use Illuminate\Support\Str; 
use App\Apartament;

class ApartamentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create(); 

        for ( $i = 0; $i < 30; $i++ ) {
            $apart = new Apartament();
            
            $apart->title = $faker->sentence(7); 
            $apart->total_rooms = rand(1, 4);
            $apart->total_beds = rand(2, 8);
            $apart->total_baths = rand(1, 2);
            $apart->square_meters = rand(40, 100);
            $apart->visible = 1;
            $apart->user_id = rand(1, 9);

            $apart->save();
        }
    }
}

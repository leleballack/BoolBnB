<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Apartament;
use App\Service;

class ApartamentServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $apart_ids = Apartament::pluck('id')->all();
        $service_ids = Service::pluck('id')->all();

        for($i=1; $i <= 30; $i++) {

            DB::table('apartament_service')->insert([
                'apartament_id' => $faker->randomElement($apart_ids),
                'service_id' => $faker->randomElement($service_ids)
            ]);

        }
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Service; 

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = ['WiFi', 'Parking', 'Swimming Pool', 'Reception', 'Spa', 'Sea view', 'Terrace'];

        foreach ($services as $service) {
            $new_service = new Service();
            $new_service->description = $service;
            $new_service->save();
        }
    }
}

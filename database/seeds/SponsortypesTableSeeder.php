<?php

use Illuminate\Database\Seeder;
use App\Sponsortype;

class SponsortypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsors = [
            [
                'description' => 'Basic',
                'price' => '2.99',
                'time_length' => '24'
            ],
            [
                'description' => 'Pro',
                'price' => '5.99',
                'time_length' => '72'
            ],
            [
                'description' => 'Premium',
                'price' => '9.99',
                'time_length' => '144'
            ]
        ];

        foreach ($sponsors as $sponsor) {
            $new_sponsor = new Sponsortype();
            $new_sponsor->description = $sponsor['description'];
            $new_sponsor->price = $sponsor['price'];
            $new_sponsor->time_length = $sponsor['time_length'];
            $new_sponsor->save();
        }
    }
}

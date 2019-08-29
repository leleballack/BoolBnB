<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker; 
use Illuminate\Support\Str; 
use App\Message;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create(); 

        for ( $i = 0; $i < 20; $i++ ) {
            $message = new Message();
            
            $message->email = $faker->email(); 
            $message->message_content = $faker->text(500);
            $message->apart_id = rand(1, 30);

            $message->save();
        }
    }
}

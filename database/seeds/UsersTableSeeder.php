<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'email' => 'pluto@test.com',
                'password' => 'password',
                'nome' => 'pluto',
                'cognome' => 'pluto',
            ],
            [
                'email' => 'pinco@test.com',
                'password' => 'password',
                'nome' => 'pinco',
                'cognome' => 'pallo',
            ],
            [
                'email' => 'radu@test.com',
                'password' => 'password',
                'nome' => 'radu',
                'cognome' => 'schirliu',
            ],
            [
                'email' => 'emanuele@test.com',
                'password' => 'password',
                'nome' => 'emanuele',
                'cognome' => 'ballacci',
            ],
            [
                'email' => 'andrea@test.com',
                'password' => 'password',
                'nome' => 'andrea',
                'cognome' => 'baldocchi',
            ],
            [
                'email' => 'antonio@test.com',
                'password' => 'password',
                'nome' => 'antonio',
                'cognome' => 'medugno',
            ],
            [
                'email' => 'mario@test.com',
                'password' => 'password',
                'nome' => 'mario',
                'cognome' => 'rossi',
            ],
            [
                'email' => 'giuseppe@test.com',
                'password' => 'password',
                'nome' => 'giuseppe',
                'cognome' => 'verdi',
            ],
            [
                'email' => 'donato@test.com',
                'password' => 'password',
                'nome' => 'donato',
                'cognome' => 'ciao',
            ]
        ];

        foreach ($users as $user) {
            $new_user = new User();
            $new_user->name = $user['nome'];
            $new_user->lastname = $user['cognome'];
            $new_user->email = $user['email'];
            $new_user->password = $user['password'];
            $new_user->save();
        }
    }
}


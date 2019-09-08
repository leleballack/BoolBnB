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
                'email' => 'utente1@test.com',
                'password' => Hash::make('password'),
                'nome' => 'pluto',
                'cognome' => 'pluto',
            ],
            [
                'email' => 'utente2@test.com',
                'password' => Hash::make('password'),
                'nome' => 'pinco',
                'cognome' => 'pallo',
            ],
            [
                'email' => 'utente3@test.com',
                'password' => Hash::make('password'),
                'nome' => 'radu',
                'cognome' => 'schirliu',
            ],
            [
                'email' => 'utente4@test.com',
                'password' => Hash::make('password'),
                'nome' => 'emanuele',
                'cognome' => 'ballacci',
            ],
            [
                'email' => 'utente5@test.com',
                'password' => Hash::make('password'),
                'cognome' => 'baldocchi',
            ],
            [
                'email' => 'utente6@test.com',
                'password' => Hash::make('password'),
                'nome' => 'antonio',
                'cognome' => 'medugno',
            ],
            [
                'email' => 'utente7@test.com',
                'password' => Hash::make('password'),
                'nome' => 'mario',
                'cognome' => 'rossi',
            ],
            [
                'email' => 'utente8@test.com',
                'password' => Hash::make('password'),
                'nome' => 'giuseppe',
                'cognome' => 'verdi',
            ],
            [
                'email' => 'utente9@test.com',
                'password' => Hash::make('password'),
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

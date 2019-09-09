<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Permission;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ApartamentsTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(ApartamentServiceTableSeeder::class);
        $this->call(SponsortypesTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);

    }
}

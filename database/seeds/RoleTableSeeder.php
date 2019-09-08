<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Permission;

class RoleTableSeeder extends Seeder
{
  public function run()
  {
    $upr = new Role();
    $upr->name = 'UPR';
    $upr->display_name = 'UPR'; // optional
    $upr->description = 'Apt Create Permission'; // optional
    $upr->save();

    $upra = new Role();
    $upra->name = 'UPRA';
    $upra->display_name = 'UPRA'; // optional
    $upra->description = 'Full Permission'; // optional
    $upra->save();

    $user = User::where('email', '=', 'utente1@test.com')->first();
    $user->attachRole($upr);

    $user = User::where('email', '=', 'pippo@pippo.it')->first();
    $user->attachRole($upra);

    $createApt = new Permission();
    $createApt->name = 'create-apt';
    $createApt->display_name = 'Create Apt';
    $createApt->description = 'create new apartaments';
    $createApt->save();

    $editApt = new Permission();
    $editApt->name = 'edit-apt';
    $editApt->display_name = 'Edit Apt';
    $editApt->description = 'edit existing apartaments';
    $editApt->save();

    $deleteApt = new Permission();
    $deleteApt->name = 'delete-apt';
    $deleteApt->display_name = 'Delete Apt';
    $deleteApt->description = 'delete existing apartaments';
    $deleteApt->save();

    $seeMsg = new Permission();
    $seeMsg->name = 'see-msg';
    $seeMsg->display_name = 'See Messages';
    $seeMsg->description = 'see message list';
    $seeMsg->save();

    $createAd = new Permission();
    $createAd->name = 'create-ad';
    $createAd->display_name = 'Create Sponsor';
    $createAd->description = 'create new sponsor';
    $createAd->save();

    $upr->attachPermission($createApt);

    $upra->attachPermissions(array($createApt, $editApt, $deleteApt, $seeMsg, $createAd));







  //   $role =
  //   [
  //       [
  //           'name' => 'UPR',
  //           'display_name' => 'Utente Reg',
  //           'description' => 'Apt Create Permission'
  //       ],
  //       [
  //           'name' => 'UPRA',
  //           'display_name' => 'Utente Reg Con Apt',
  //           'description' => 'Full Permission'
  //       ],
  //   ];
  //
  //   foreach ($role as $key => $value) {
  //       Role::create($value);
  //   }
  //
  //
  //   $permission = Permission::get();
  //
  //
  //   $user =
  //   [
  //       [
  //         'name' => 'Pippo',
  //         'email' => 'utente1@test.com',
  //         'password' => Hash::make('password')
  //       ],
  //       [
  //         'name' => 'Pluto',
  //         'email' => 'utente2@test.com',
  //         'password' => Hash::make('password')
  //       ],
  //   ];
  //
  //   foreach ($user as $key => $value) {
  //     $user = User::create($user);
  //     $user->attachRole($role);
  }
}

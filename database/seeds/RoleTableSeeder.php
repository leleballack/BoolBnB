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
    $upr->display_name = 'UPR';
    $upr->description = 'Apt Create Permission';
    $upr->save();

    $upra = new Role();
    $upra->name = 'UPRA';
    $upra->display_name = 'UPRA';
    $upra->description = 'Full Permission';
    $upra->save();

    // $user = User::where('email', '=', 'utente1@test.com')->first();
    // $user->attachRole($upr);
    //
    // $user = User::where('email', '=', 'utente2@test.com')->first();
    // $user->attachRole($upra);

    // $createApt = new Permission();
    // $createApt->name = 'create-apt';
    // $createApt->display_name = 'Create Apt';
    // $createApt->description = 'create new apartaments';
    // $createApt->save();
    //
    // $editApt = new Permission();
    // $editApt->name = 'edit-apt';
    // $editApt->display_name = 'Edit Apt';
    // $editApt->description = 'edit existing apartaments';
    // $editApt->save();
    //
    // $deleteApt = new Permission();
    // $deleteApt->name = 'delete-apt';
    // $deleteApt->display_name = 'Delete Apt';
    // $deleteApt->description = 'delete existing apartaments';
    // $deleteApt->save();
    //
    // $seeMsg = new Permission();
    // $seeMsg->name = 'see-msg';
    // $seeMsg->display_name = 'See Messages';
    // $seeMsg->description = 'see message list';
    // $seeMsg->save();
    //
    // $createAd = new Permission();
    // $createAd->name = 'create-ad';
    // $createAd->display_name = 'Create Sponsor';
    // $createAd->description = 'create new sponsor';
    // $createAd->save();
    //
    // $upr->attachPermission($createApt);
    //
    // $upra->attachPermissions(array($createApt, $editApt, $deleteApt, $seeMsg, $createAd));

  }
}

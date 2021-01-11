<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table('users')->delete();
        $users = [
            [
                'name' => 'Franke Developer',
                'email' => 'frankedeveloper@gmail.com',
                'username' => 'franke.developer',
                'password' => 123,
                'slug' => 'franke-developer'
            ],
            [
                'name' => 'Aldo',
                'email' => 'aldo@aztlan.com',
                'username' => 'aldo.aztlan',
                'password' => 123,
                'slug' => 'aldo-aztlan'
            ],
            [
                'name' => 'Igor Aztlan',
                'email' => 'igor@aztlan.com',
                'username' => 'igor.aztlan',
                'password' => 123,
                'slug' => 'igor-aztlan'
            ],
        ];

        DB::table('roles')->delete();
        $roles = file_get_contents(base_path('seeds/roles.json'));
        $roles = json_decode($roles);

        DB::table('permissions')->delete();
        $permissions = file_get_contents(base_path('seeds/permissions.json'));
		$permissions = json_decode($permissions);

        foreach($permissions->permissions as $perm) {
            DB::table('permissions')->insert((array)$perm);;
        }

        foreach($roles->roles as $role) {
            DB::table('roles')->insert((array)$role);
        }

        foreach ($users as $user) {
            User::create($user);
        }

        $franke = User::where('username', 'franke.developer')->first();
        $aldo = User::where('username', 'aldo.aztlan')->first();
        $igor = User::where('username', 'aldo.aztlan')->first();
        $franke->assignRole('SuperAdmin');
        $aldo->assignRole('SuperAdmin');
        $igor->assignRole('SuperAdmin');
    }

}

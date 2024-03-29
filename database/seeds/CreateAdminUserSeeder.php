<?php

use Illuminate\Database\Seeder;
use App\Models\Moderator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Moderator::create([
            'name' => 'Doba nabile',
            'email' => 'doba@gmail.com',
            'status' => 1,
            'dark_mode' => 1,
            'password' => bcrypt('123456789')
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}

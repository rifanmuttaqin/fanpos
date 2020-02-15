<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Model\User\User;


class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// Get First User at first time 
    	$user = User::all()->first();

    	if($user != null)
    	{
    		// Reset cached roles and permissions
	        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

	        // Create permissions
	        $this->createPermission();
	     	        
	        // create roles and assign created permissions
	        $role_admin 	= Role::create(['name' => 'Admin']);
	        $role_creator 	= Role::create(['name' => 'Creator']);
	        $role_guru 		= Role::create(['name' => 'Employee']);
	        	     
	        // Assigning User to ROLE first time
	        $user->assignRole('Creator');

	        // Assign All Permission to creator role
	        $role_creator->givePermissionTo(Permission::all());
            $role_admin->givePermissionTo(Permission::all());
                
            // Assign Default Permission to Employee
           
    	}
    }

    /**
    * 
    */
    private function createPermission()
    {
    	// ------ Home ----- 
       	Permission::create(['name' => 'index home']);

        // --------- User ---------------------
        Permission::create(['name' => 'index user']);
        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);

        // --------- Role ---------------------
        Permission::create(['name' => 'index role']);
        Permission::create(['name' => 'update role']);
        
        // --------- Report ---------------------
        Permission::create(['name' => 'all report']);

        // --------- Profile ---------------------
        Permission::create(['name' => 'index profile']);
        Permission::create(['name' => 'update profile']);

        // ----------- Notification -----------------
        Permission::create(['name' => 'index notification']);
        Permission::create(['name' => 'create notification']);
    }
}

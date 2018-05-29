<?php

use App\User;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    /**
	     * Add Roles
	     *
	     */
    	if (Role::where('name', '=', 'Admin')->first() === null) {
	        $adminRole = Role::create([
	            'name' => 'Admin',
	            'slug' => 'admin',
	            'description' => 'Admin Role',
	            'level' => 100,
        	]);
	    }

    	if (Role::where('name', '=', 'User')->first() === null) {
	        $userRole = Role::create([
	            'name' => 'User',
	            'slug' => 'user',
	            'description' => 'User Role',
	            'level' => 2,
	        ]);
	    }
      if (Role::where('name', '=', 'Upgraded_User')->first() === null) {
	        $userRole = Role::create([
	            'name' => 'Upgraded_User',
	            'slug' => 'Upgraded_User',
	            'description' => 'User Role',
	            'level' => 3,
	        ]);
	    }

    	if (Role::where('name', '=', 'Unverified_user')->first() === null) {
	        $userRole = Role::create([
	            'name' => 'Unverified_user',
	            'slug' => 'unverified_user',
	            'description' => 'Unverified Role',
	            'level' => 0,
	        ]);
	    }
      if (Role::where('name', '=', 'Unverified_business_user')->first() === null) {
	        $userRole = Role::create([
	            'name' => 'Unverified_business_user',
	            'slug' => 'unverified_business_user',
	            'description' => 'Unverified Role',
	            'level' => 10,
	        ]);
	    }
      if (Role::where('name', '=', 'business_user')->first() === null) {
	        $userRole = Role::create([
	            'name' => 'business_user',
	            'slug' => 'business_user',
	            'description' => 'Business Role',
	            'level' => 11,
	        ]);
	    }

    }

}

<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $a = Role::query()->create([
            "name"=> "admin",
        ]);
        $a->permissions()->sync(Permission::all());


        if (!DB::table('users')->where('email', 'admin@gmail.com')->exists()) {
            DB::table('users')->insert([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123'),
                'role_id' => $a->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
    }
}

<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::query()->insert(
    [
        ["title"=>"insert-category"],
        ["title"=>"update-category"],
        ["title"=>"delete-category"],
        ["title"=>"read-category"],
        ["title"=>"update-post"],
        ["title"=>"delete-post"],
        ["title"=>"read-post"],
        ["title"=>"insert-post"],
        ["title"=>"update-user"],
        ["title"=>"delete-user"],
        ["title"=>"read-user"],
        ["title"=>"insert-user"],
        ["title"=>"update-role"],
        ["title"=>"delete-role"],
        ["title"=>"read-role"],
        ["title"=>"insert-role"],
    ]);
    $b = Role::query()->create([
        "name"=> "normal",
    ]);
    $permission = Permission::where('title', 'read-post')->first();
    
    if ($permission) {
    $b->permissions()->sync([$permission->id]); // ارسال آرایه‌ای از شناسه‌ها
}
    }

}

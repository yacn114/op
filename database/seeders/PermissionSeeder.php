<?php

namespace Database\Seeders;

use App\Models\Permission;
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

        ]
        );
    }
}

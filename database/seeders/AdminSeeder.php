<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            "username" => "admin",
            "password" => Hash::make("Admin12345"),
            "name" => "Admin",
            "code" => 1205,
            "role" => 1,
        ]);
    }
}

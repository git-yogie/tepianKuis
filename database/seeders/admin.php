<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class admin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new \App\Models\admin();
        $admin->username = "admin_real";
        $admin->password = bcrypt("admin_real");
        $admin->nama = "Administrator";
        $admin->save();

    }
}

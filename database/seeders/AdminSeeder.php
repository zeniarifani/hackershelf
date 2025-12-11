<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' =>'admin',
            'email'=>'yumichuu51@gmail.com',
            'password'=>Hash::make('admin123'),
            'role'=>'admin',
        ]);
    }
}

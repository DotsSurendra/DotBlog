<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $userDetail = User::updateOrcreate([
            'name'=> 'surendra singh parihar',
            'email'=>'surendra.parihar@dotsquare.com',
            'password'=>'admin123',
            'phone'=>'9587238512',
            'role'=>'admin',
            'email_verify'=>'1'
        ]);
    }
}

<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       $user1 =  User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'type' => 'System User',
        ]);
        $user1->assignRole('user');

        $user2 =  User::create([
            'name' => 'Asim Khan',
            'email' => 'deeds2595@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'type' => 'System User',
        ]);
        $user2->assignRole('user');

        $user3 =  User::create([
            'name' => 'Asim Khan',
            'email' => 'webtimecreative@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'type' => 'System User',
        ]);
        $user3->assignRole('user');

        $user4 =  User::create([
            'name' => 'Asim Khan',
            'email' => 'basitawan.abdul@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'type' => 'System User',
        ]);
        $user4->assignRole('user');

        $user5 =  User::create([
            'name' => 'Admin',
            'email' => 'admin@menainsurance.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'type' => 'Admin',
        ]);
        $user5->assignRole('user');
    }
}

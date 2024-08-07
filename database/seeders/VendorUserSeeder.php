<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
class VendorUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendor =  User::create([
            'name' => 'Vendor',
            'email' => 'vendor@vendor.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'type' => 'System User',
        ]);
        $vendor->assignRole('vendor_user');
    }
}

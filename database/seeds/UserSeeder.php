<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Fairuz',
            'email' => 'a@a.com',
            'password' => bcrypt('123'),
            'phone' => '+60136252699',
            'address' => '14, Jalan Bunga Buah Satu 27/38A, Seksyen 27, 40400 Shah Alam'
        ]);
    }
}

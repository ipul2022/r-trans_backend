<?php

namespace Database\Seeders;

use App\Models\AcceptOrder;
use Illuminate\Database\Seeder;
use App\Models\Driver;
use App\Models\Price;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
        * Run the database seeds.
        *
        * @return void
        */
    public function run()
    {
        Driver::create([
            'name' => 'Messi',
            'email' => '11@gmail.com',
            'phone'=>'08584454662987',
            'jenis_kendaraan' => 'beat',
            'nomor_kendaraan'=>'A 4453 FG',
            'gender'=>'laki-laki',
            // 'username' => 'haresh',
            'password' => bcrypt('123456')
        ]);
        Driver::create([
            'name' => 'ROnaldo',
            'email' => '12@gmail.com',
            'phone'=>'08584454662342',
            'jenis_kendaraan' => 'supra',
            'nomor_kendaraan'=>'A 4453 FT',
            'gender'=>'laki-laki',
            // 'username' => 'haresh',
            'password' => bcrypt('123456')
        ]);
        Driver::create([
            'name' => 'Neymar',
            'email' => '13@gmail.com',
            'phone'=>'08584454662454',
            'jenis_kendaraan' => 'nmax',
            'nomor_kendaraan'=>'A 4453 FK',
            'gender'=>'laki-laki',
            // 'username' => 'haresh',
            'password' => bcrypt('123456')
        ]);

        User::create([
            'name' => 'DJ Tanti',
            'email' => '22@gmail.com',
            'phone'=>'0858445466225',
            'roles' => 'user',
            'image'=>'https://source.unsplash.com/user/c_v_r/1900x800',
            'password' => bcrypt('123456')
        ]);
        User::create([
            'name' => 'Reyamanda',
            'email' => '33@gmail.com',
            'phone'=>'0858445466226',
            'roles' => 'user',
            'image'=>'https://picsum.photos/200/300',
            'password' => bcrypt('123456')
        ]);
        User::create([
            'name' => 'Suci Hastuti',
            'email' => '44@gmail.com',
            'phone'=>'0858445466227',
            'roles' => 'user',
            'image'=>'https://source.unsplash.com/user/c_v_r/100x100',
            'password' => bcrypt('123456')
        ]);
        User::create([
            'name' => 'admin rtrans',
            'email' => 'takeoncam@gmail.com',
            'phone'=>'0858445466229',
            'roles' => 'admin',
            'password' => bcrypt('123456')
        ]);
        Price::create([
            'price' => '10000',

        ]);

    }
}

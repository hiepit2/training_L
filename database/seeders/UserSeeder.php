<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Days;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return [
            'email' => $this->faker->email,
            'name' => $this->faker->name,
            'password' => bcrypt('123'),
        ];
        // DB::table('students')->insert([
        //     'name' => Str::random(10),
        //     'address' => Str::random(10),
        //     'birthday' => Carbon::now(),
        //     'phone' => Str::random(10),
        //     'gender' => Str::randomElement(['1', '0']),
        //     'code' => '000001',
        //     'email' => Str::random(10).'@gmail.com',
        //     'user_id' => Str::random(100),
        //     'avatar' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSErd3GQcEwGOfzFCIS2BdXBdOHHPIFwTBdMg&usqp=CAU',
        // ]);

        
        // dd(DB::table('users')->id);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $faker = Faker::create();
        $student = Student::pluck('id')->all();
        $subject = Subject::pluck('id')->all();
        for($i =  1; $i <= 100; $i++) {
            DB::table('student_subject')->insert([
                'subject_id' => $faker->randomElement($subject),
                'student_id' => $faker->randomElement($student),
                'point' => rand(0, 10),
            ]);
        }
        
    }
}

<?php

use App\Models\Specialization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specializations')->delete();
        $specializations = [
            ['en'=> 'Arabic', 'ar'=> 'عربي'],
            ['en'=> 'Sciences', 'ar'=> 'علوم'],
            ['en'=> 'Computer', 'ar'=> 'حاسب الي'],
            ['en'=> 'English', 'ar'=> 'انجليزي'],

            ['en'=> 'History', 'ar'=> 'تاريخ'],
            ['en'=> 'Geography', 'ar'=> 'جغرافيا'],
            ['en'=> 'psychology', 'ar'=> 'علم نفس'],
            ['en'=> 'philosophy', 'ar'=> 'فلسفة'],

            ['en'=> 'Algebra', 'ar'=> 'جبر'],
            ['en'=> 'Differential', 'ar'=> 'تفاضل'],
            ['en'=> 'Mechanics', 'ar'=> 'ميكانيكا'],
            ['en'=> 'Static', 'ar'=> 'استاتيكا'],

            
            ['en'=> 'Biology', 'ar'=> 'احياء'],
            ['en'=> 'Chemistry', 'ar'=> 'كيمياء'],
            ['en'=> 'Physics ', 'ar'=> 'فيزياء'],
            ['en'=> 'environment Science', 'ar'=> 'علوم البيئة'],
            ['en'=> 'geology', 'ar'=> 'جولوجيا'],

        ];
        foreach ($specializations as $S) {
            Specialization::create(['Name' => $S]);
        }
    }
}
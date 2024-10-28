<?php

namespace Database\Seeders;

use App\Models\Section;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $section = [
            ['department_id' => 1, 'name' => 'Section A-1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['department_id' => 1, 'name' => 'Section A-2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['department_id' => 1, 'name' => 'Section A-3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['department_id' => 1, 'name' => 'Section A-4', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['department_id' => 1, 'name' => 'Section A-5', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['department_id' => 2, 'name' => 'Section B-1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['department_id' => 2, 'name' => 'Section B-2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['department_id' => 2, 'name' => 'Section B-3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['department_id' => 3, 'name' => 'Section C-1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['department_id' => 3, 'name' => 'Section C-2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['department_id' => 4, 'name' => 'Section D-1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['department_id' => 5, 'name' => 'Section E-1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['department_id' => 5, 'name' => 'Section E-2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['department_id' => 5, 'name' => 'Section E-3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['department_id' => 5, 'name' => 'Section E-4', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
        ];

        Section::insert($section);
    }
}

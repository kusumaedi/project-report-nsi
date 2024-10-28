<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $department = [
            ['name' => 'Department A', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Department B', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Department C', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Department D', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Department E', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
        ];

        Department::insert($department);
    }
}

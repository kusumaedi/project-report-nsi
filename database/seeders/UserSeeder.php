<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            ['username' => 'admin', 'department_id' => 1, 'section_id' => 1, 'name' => 'ADMIN', 'email' => 'admin@gmail.com', 'password' => Hash::make('admin'), 'department' => 'Department A', 'section' => 'Section A-1', 'role' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['username' => 'reviewer', 'department_id' => 2, 'section_id' => 6, 'name' => 'Aku Reviewer', 'email' => 'reviewer@gmail.com', 'password' => Hash::make('reviewer'), 'department' => 'Department B', 'section' => 'Section B-1', 'role' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['username' => 'approver1', 'department_id' => 3, 'section_id' => 9, 'name' => 'Saya Approver 1', 'email' => 'approver1@gmail.com', 'password' => Hash::make('approver1'), 'department' => 'Department C', 'section' => 'Section C-1', 'role' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['username' => 'approver2', 'department_id' => 3, 'section_id' => 10, 'name' => 'Abdi Approver 2', 'email' => 'approver2@gmail.com', 'password' => Hash::make('approver2'), 'department' => 'Department C', 'section' => 'Section C-2', 'role' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['username' => 'user', 'department_id' => 1, 'section_id' => 2, 'name' => 'USER', 'email' => 'user@gmail.com', 'password' => Hash::make('user'), 'department' => 'Department A', 'section' => 'Section A-2', 'role' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['username' => 'user2', 'department_id' => 1, 'section_id' => 3, 'name' => 'User 2', 'email' => 'user2@gmail.com', 'password' => Hash::make('user2'), 'department' => 'Department A', 'section' => 'Section A-3', 'role' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['username' => 'user3', 'department_id' => 1, 'section_id' => 4, 'name' => 'User 3', 'email' => 'user3@gmail.com', 'password' => Hash::make('user3'), 'department' => 'Department A', 'section' => 'Section A-4', 'role' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

        ];

        User::insert($user);
    }
}

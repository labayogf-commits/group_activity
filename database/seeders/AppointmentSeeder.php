<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('job_positions')->insert([
            ['title' => 'Software Engineer', 'department' => 'Information Technology', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'DevOps Engineer', 'department' => 'Information Technology', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Data Analyst', 'department' => 'Information Technology', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('interview_types')->insert([
            ['stage_name' => 'Phone Screen', 'color_code' => 'blue', 'created_at' => now(), 'updated_at' => now()],
            ['stage_name' => 'Technical Interview', 'color_code' => 'indigo', 'created_at' => now(), 'updated_at' => now()],
            ['stage_name' => 'System Design Interview', 'color_code' => 'emerald', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('candidates')->insert([
            ['name' => 'Arnold Jay Camar', 'email' => 'arnoldcamar47@gmail.com', 'github_handle' => 'arrjay27', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alyssa Techson', 'email' => 'alyssa.techson@example.com', 'github_handle' => 'alyssatech', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kevin Chen', 'email' => 'kevin.chen@example.com', 'github_handle' => 'kevincode', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

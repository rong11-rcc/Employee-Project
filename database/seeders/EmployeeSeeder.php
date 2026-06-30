<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // Clear existing data
        DB::table('employees')->delete();

        // Insert employees
        DB::table('employees')->insert([
            [
                'name' => 'John Smith',
                'age' => 30,
                'position' => 'Software Developer',
                'salary' => 75000.00,
                'image' => 'employees/images/john.jpg',
                'file' => 'employees/files/john_cv.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sarah Johnson',
                'age' => 28,
                'position' => 'Web Designer',
                'salary' => 65000.00,
                'image' => 'employees/images/sarah.jpg',
                'file' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mike Wilson',
                'age' => 35,
                'position' => 'Project Manager',
                'salary' => 85000.00,
                'image' => null,
                'file' => 'employees/files/mike_contract.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Emily Brown',
                'age' => 32,
                'position' => 'HR Manager',
                'salary' => 70000.00,
                'image' => 'employees/images/emily.jpg',
                'file' => 'employees/files/emily_resume.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'David Lee',
                'age' => 40,
                'position' => 'Senior Developer',
                'salary' => 95000.00,
                'image' => 'employees/images/david.jpg',
                'file' => 'employees/files/david_cert.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        echo "✓ Seeded 5 employees successfully\n";
    }
}

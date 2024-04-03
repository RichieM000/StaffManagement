<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Staff;
use App\Models\WorkSchedule;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Seed 10 staff members with work schedules
        for ($i = 1; $i <= 10; $i++) {
            $staff = Staff::create([
                'firstname' => 'Staff' . $i,
                'lastname' => 'Lastname' . $i,
                'gender' => ($i % 2 == 0) ? 'male' : 'female', // Alternate genders for example
                'age' => rand(20, 50), // Random age between 20 and 50
                'address' => 'Address' . $i,
                'email' => 'staff' . $i . '@example.com',
                'phone' => '123456789' . $i,
                'jobrole' => 'jobrole' . $i,
            ]);

            // Create work schedule for each staff member
            WorkSchedule::create([
                'staff_id' => $staff->id,
                'day_of_week' => 'Monday',
                'start_time' => Carbon::createFromTime(rand(7, 10), 0, 0), // Random start time between 7 AM and 10 AM
                'end_time' => Carbon::createFromTime(rand(16, 19), 0, 0), // Random end time between 4 PM and 7 PM
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;

class AppointmentSeeder extends Seeder
{
    public function run()
    {
        Appointment::create([
            'patient_name' => 'John Doe',
            'email' => 'john@example.com',
            'service' => 'cleaning',
            'date' => '2024-03-20',
            'time' => '10:00:00',
            'status' => 'scheduled'
        ]);

        Appointment::create([
            'patient_name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'service' => 'checkup',
            'date' => '2024-03-21',
            'time' => '14:30:00',
            'status' => 'scheduled'
        ]);
    }
} 
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::latest()->get();
        return view('appointments', compact('appointments'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'patient_name' => 'required|string|max:255',
                'email' => 'required|email',
                'service' => 'required|string',
                'date' => 'required|date',
                'time' => 'required',
            ]);

            $validated['status'] = 'scheduled'; // Set default status

            Appointment::create($validated);

            return redirect()->route('appointments.index')
                ->with('success', 'Appointment created successfully');
        } catch (\Exception $e) {
            return redirect()->route('appointments.index')
                ->with('error', 'Error creating appointment: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'patient_name' => 'required|string|max:255',
            'service' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'email' => 'required|email',
        ]);

        $appointment->update($validated);

        return redirect()->route('appointments')->with('success', 'Appointment updated successfully');
    }

    public function destroy(Appointment $appointment)
    {
        try {
            $appointment->delete();
            return response()->json(['success' => true, 'message' => 'Appointment cancelled successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error cancelling appointment'], 500);
        }
    }

    public function show(Appointment $appointment)
    {
        return response()->json($appointment);
    }
} 
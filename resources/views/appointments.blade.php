<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dental Clinic - Appointments</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        @if (file_exists(public_path('build/manifest.json')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="https://cdn.tailwindcss.com"></script>
        @endif

        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body class="antialiased bg-gray-50 dark:bg-gray-900">
        <!-- Sidebar (same as dashboard) -->
        <div class="fixed inset-y-0 left-0 w-64 bg-white dark:bg-gray-800 shadow-lg">
            <div class="flex items-center justify-center h-16 border-b dark:border-gray-700">
                <svg class="w-8 h-8 text-blue-600 dark:text-blue-400 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3c.966 0 1.89.396 2.556 1.098C15.224 4.8 16 5.974 16 7.5c0 2.345-1.679 4.277-3.378 5.785a.75.75 0 01-.844 0C10.079 11.777 8.4 9.845 8.4 7.5c0-1.526.776-2.7 1.444-3.402C10.51 3.396 11.434 3 12 3z"/>
                </svg>
                <span class="text-xl font-bold text-gray-900 dark:text-white">Dental Clinic</span>
            </div>
            
            <nav class="mt-6">
                <div class="px-4 space-y-2">
                    <a href="{{ url('/dashboard') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('appointments.index') }}" class="flex items-center px-4 py-2 text-gray-700 bg-gray-100 rounded-lg dark:bg-gray-700 dark:text-gray-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Appointments
                    </a>
                    <a href="{{ route('services') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Dental Services
                    </a>
                    <a href="{{ route('schedule') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Schedule
                    </a>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="ml-64 p-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Appointments</h1>
                <button onclick="openAppointmentModal()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    New Appointment
                </button>
            </div>

            <!-- Appointment Filters -->
            <div class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date Range</label>
                    <input type="date" class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                    <select class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800">
                        <option value="">All Status</option>
                        <option value="scheduled">Scheduled</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Service</label>
                    <select class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800">
                        <option value="">All Services</option>
                        <option value="cleaning">Teeth Cleaning</option>
                        <option value="checkup">Regular Checkup</option>
                        <option value="rootcanal">Root Canal</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Search</label>
                    <input type="text" placeholder="Search patients..." 
                        class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800">
                </div>
            </div>

            <!-- Appointments Table -->
            <div class="bg-white dark:bg-gray-800 shadow overflow-x-auto rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Patient
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Service
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Date & Time
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($appointments as $appointment)
                            <tr data-appointment-id="{{ $appointment->id }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $appointment->patient_name }}
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $appointment->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">{{ $appointment->service }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">{{ date('M d, Y', strtotime($appointment->date)) }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ date('h:i A', strtotime($appointment->time)) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($appointment->status == 'scheduled') bg-green-100 text-green-800 
                                        @elseif($appointment->status == 'completed') bg-blue-100 text-blue-800 
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button onclick="viewAppointment({{ $appointment->id }})" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 mr-3">View</button>
                                    <button onclick="editAppointment({{ $appointment->id }})" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 mr-3">Edit</button>
                                    <button onclick="deleteAppointment({{ $appointment->id }})" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Cancel</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-center">
                                    No appointments found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4 flex items-center justify-between">
                <div class="flex-1 flex justify-between sm:hidden">
                    <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Previous
                    </button>
                    <button class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Next
                    </button>
                </div>
            </div>

            <!-- New Appointment Modal -->
            <div id="appointmentModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">New Appointment</h3>
                        <button onclick="closeAppointmentModal()" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <form id="newAppointmentForm" method="POST" action="{{ route('appointments.store') }}" class="mt-4">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Patient Name</label>
                            <input type="text" name="patient_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                            <input type="email" name="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Service</label>
                            <select name="service" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                                <option value="">Select a service</option>
                                <option value="cleaning">Teeth Cleaning</option>
                                <option value="checkup">Regular Checkup</option>
                                <option value="rootcanal">Root Canal</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
                            <input type="date" name="date" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Time</label>
                            <input type="time" name="time" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">
                                Schedule Appointment
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- View Appointment Modal -->
            <div id="viewAppointmentModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Appointment Details</h3>
                        <button onclick="closeViewModal()" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div id="appointmentDetails" class="mt-4">
                        <!-- Details will be populated by JavaScript -->
                    </div>
                </div>
            </div>

            <!-- Edit Appointment Modal -->
            <div id="editAppointmentModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Edit Appointment</h3>
                        <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <form id="editAppointmentForm" class="mt-4">
                        @method('PUT')
                        @csrf
                        <input type="hidden" id="edit_appointment_id">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Patient Name</label>
                            <input type="text" id="edit_patient_name" name="patient_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                            <input type="email" id="edit_email" name="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Service</label>
                            <select id="edit_service" name="service" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                                <option value="">Select a service</option>
                                <option value="cleaning">Teeth Cleaning</option>
                                <option value="checkup">Regular Checkup</option>
                                <option value="rootcanal">Root Canal</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
                            <input type="date" id="edit_date" name="date" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Time</label>
                            <input type="time" id="edit_time" name="time" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">
                                Update Appointment
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Add this near the top of the page to show success/error messages -->
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
        </div>

        <!-- JavaScript for Modal -->
        <script>
            // Function to check for URL hash and open modal
            function checkHashAndOpenModal() {
                if (window.location.hash === '#new') {
                    openAppointmentModal();
                    // Remove the hash to prevent modal from reopening on refresh
                    history.replaceState(null, null, ' ');
                }
            }

            function openAppointmentModal() {
                document.getElementById('appointmentModal').classList.remove('hidden');
            }

            // Close modal when clicking outside
            document.getElementById('appointmentModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.add('hidden');
                }
            });

            // Add close button functionality
            function closeAppointmentModal() {
                document.getElementById('appointmentModal').classList.add('hidden');
            }

            // Check for hash on page load
            window.addEventListener('load', checkHashAndOpenModal);

            // Function to view appointment details
            function viewAppointment(id) {
                fetch(`/appointments/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        const details = document.getElementById('appointmentDetails');
                        details.innerHTML = `
                            <div class="space-y-4">
                                <p><strong>Patient:</strong> ${data.patient_name}</p>
                                <p><strong>Email:</strong> ${data.email}</p>
                                <p><strong>Service:</strong> ${data.service}</p>
                                <p><strong>Date:</strong> ${data.date}</p>
                                <p><strong>Time:</strong> ${data.time}</p>
                                <p><strong>Status:</strong> ${data.status}</p>
                            </div>
                        `;
                        document.getElementById('viewAppointmentModal').classList.remove('hidden');
                    });
            }

            // Function to edit appointment
            function editAppointment(id) {
                fetch(`/appointments/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('edit_appointment_id').value = data.id;
                        document.getElementById('edit_patient_name').value = data.patient_name;
                        document.getElementById('edit_email').value = data.email;
                        document.getElementById('edit_service').value = data.service;
                        document.getElementById('edit_date').value = data.date;
                        document.getElementById('edit_time').value = data.time;
                        document.getElementById('editAppointmentModal').classList.remove('hidden');
                    });
            }

            // Function to delete appointment
            function deleteAppointment(id) {
                if (confirm('Are you sure you want to cancel this appointment?')) {
                    fetch(`/appointments/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Show success message
                            const alertDiv = document.createElement('div');
                            alertDiv.className = 'mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative';
                            alertDiv.innerHTML = `<span class="block sm:inline">${data.message}</span>`;
                            
                            // Insert alert before the table
                            const tableDiv = document.querySelector('.bg-white.shadow');
                            tableDiv.parentNode.insertBefore(alertDiv, tableDiv);

                            // Remove the cancelled appointment row
                            const appointmentRow = document.querySelector(`tr[data-appointment-id="${id}"]`);
                            if (appointmentRow) {
                                appointmentRow.remove();
                            } else {
                                // If row not found, refresh the page
                                window.location.reload();
                            }

                            // Remove alert after 3 seconds
                            setTimeout(() => {
                                alertDiv.remove();
                            }, 3000);
                        } else {
                            alert('Error cancelling appointment. Please try again.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error cancelling appointment. Please try again.');
                    });
                }
            }

            // Close modals
            function closeViewModal() {
                document.getElementById('viewAppointmentModal').classList.add('hidden');
            }

            function closeEditModal() {
                document.getElementById('editAppointmentModal').classList.add('hidden');
            }

            // Handle edit form submission
            document.getElementById('editAppointmentForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const id = document.getElementById('edit_appointment_id').value;
                const formData = new FormData(this);

                fetch(`/appointments/${id}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                }).then(response => {
                    if (response.ok) {
                        window.location.reload();
                    }
                });
            });

            // Update the form submission handling
            document.getElementById('newAppointmentForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                }).then(response => {
                    if (response.ok) {
                        window.location.reload();
                    } else {
                        alert('Error creating appointment. Please try again.');
                    }
                }).catch(error => {
                    console.error('Error:', error);
                    alert('Error creating appointment. Please try again.');
                });
            });
        </script>
    </body>
</html> 
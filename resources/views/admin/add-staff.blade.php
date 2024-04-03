<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <!-- Main content with sidebar -->
    <div class="flex">
        <x-sidebar /> <!-- Include the sidebar component -->

        <div class="container md:w-3/4 lg:w-9/12 mx-12 py-6">
            <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold mb-4">Add New Staff</h1>
            <a href="{{route('admin.staff')}}" class="bg-button px-6 py-1 text-white rounded-md hover:bg-hover">Back</a>
        </div>
            <div class="bg-white shadow-md rounded-lg p-6 mx-auto">
                <form action="{{ route('addstaff') }}" method="POST" class="grid grid-cols-2 gap-3">
                    @csrf
                    <div class="mb-4">
                        <label for="firstname" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" name="firstname" id="firstname" class="mt-1 p-2 capitalize border border-gray-300 rounded-md w-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="lastname" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" name="lastname" id="lastname" class="mt-1 p-2 border capitalize border-gray-300 rounded-md w-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                        <select name="gender" id="gender" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                        <input type="text" name="age" id="age" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                    </div>
                    <div class="mb-4">
                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                        <input type="text" name="address" id="address" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                    </div>

                    
                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone No.</label>
                        <input type="tel" name="phone" id="phone" maxlength="11" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                    </div>
                    <div class="mb-4">
                        <label for="jobrole" class="block text-sm font-medium text-gray-700">Job Role</label>
                        <select name="jobrole" id="jobrole" class="mt-1 p-2 border overflow-y-auto border-gray-300 rounded-md w-full" required>
                            <option value="Kapitan">Kapitan</option>
                            <option value="Vice Kap">Vice Kap</option>
                            <option value="Secretary">Secretary</option>
                            <option value="Treasurer">Treasurer</option>
                            <option value="Chairman">Chairman</option>
                            <option value="Kagawad">Kagawad</option>
                            <option value="Tanod">Tanod</option>
                            <option value="SK">SK</option>
                        </select>
                    </div>
                    <!-- Other staff fields (age, address, email, phone) can be added similarly -->
    
                    <!-- Work Schedule Inputs -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-4">Work Schedule</label>
                        <div class="sm:grid-cols-2 gap-4">
                            <div>
                                <label for="day_of_week" class="block text-sm font-medium text-gray-700">Day of Week</label>
                                <input type="text" name="day_of_week" id="day_of_week" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                            </div>
                            <div>
                                <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
                                <input type="time" name="start_time" id="start_time" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                            </div>
                            <div>
                                <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
                                <input type="time" name="end_time" id="end_time" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                            </div>
                        </div>
                    </div>
    
                    <div class="col-span-2 m-auto">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Add Staff</button>
                    </div>
                </form>
            </div>
        </div>
</x-app-layout>






<!-- List of staff members -->
{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Staff Information</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($staff as $staffMember)
                    <tr>
                        <td>{{ $staffMember->name }}</td>
                        <td>{{ $staffMember->email }}</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection --}}

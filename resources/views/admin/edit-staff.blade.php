<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <!-- Main content with sidebar -->
    <div class="flex">
        <x-sidebar /> <!-- Include the sidebar component -->

        <div class="container m-auto md:w-3/4 lg:w-5/12 py-6">
            <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold mb-4">Update Staff</h1>
            <a href="/admin/staff" class="bg-button px-6 py-1 text-white rounded-md hover:bg-hover">Back</a>
        </div>
            <div class="bg-white shadow-md rounded-lg p-6 mx-auto">
                <form action="/update/staff/{{$user->id}}" method="POST" class="grid grid-cols-2 gap-3">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="firstname" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" name="fname" id="firstname" value="{{ $user->fname }}" class="mt-1 p-2 border capitalize border-gray-300 rounded-md w-full">
                    </div>
                    <div class="mb-4">
                        <label for="lastname" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" name="lname" id="lastname" value="{{ $user->lname }}" class="mt-1 p-2 border capitalize border-gray-300 rounded-md w-full">
                    </div>
                    <div class="mb-4">
                        <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                        <select name="gender" id="gender" value="{{ $user->gender }}" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                            <option value="male" @if($user->gender === 'male') selected @endif>Male</option>
                            <option value="female" @if($user->gender === 'female') selected @endif>Female</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                        <input type="text" name="age" id="age" value="{{ $user->age }}" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                    </div>
                    <div class="mb-4">
                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                        <input type="text" name="address" id="address" value="{{ $user->address }}" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ $user->email }}" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                    </div>
                    
                    
                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone No.</label>
                        <input type="tel" name="phone" id="phone" value="{{ $user->phone }}" maxlength="11" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                    </div>

                      <div class="col-span-2">
            <x-input-label for="jobrole" :value="__('Job Role')" />
            <select name="jobrole" id="jobrole" value="{{ $user->jobrole }}" class="mt-1 p-2 borderoverflow-y-auto border-gray-300 rounded-md w-full">
                <option>--Select Job Role--</option>
                <option value="Chairman">Chairman</option>
                <option value="Secretary">Secretary</option>
                <option value="Treasurer">Treasurer</option>
                <option value="Kagawad">Kagawad</option>
                <option value="Tanod">Tanod</option>
                <option value="SK Chairman">SK Chairman</option>
                <option value="SK">SK</option>
                <option value="Clerk">Clerk</option>
                <option value="BHW">Barangay Health Workers</option>
                
            </select>
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div class="col-span-2 mt-4"  id="checkboxDiv">
            <x-input-label for="kagawad_checkbox" id="checkboxLabel"  class="mb-3" :value="__('Committee On:')" />
            <div class="grid grid-cols-2">
                <!-- Add the hidden class to hide the checkboxes initially -->
                <label for="agriculture_checkbox" class="mb-3 items-center hidden">
                    <input type="checkbox" name="committee_roles[]" value="Agriculture" class="mt-1 p-2 border border-gray-300 rounded-md" disabled>
                    <span class="ml-1">Agriculture</span>
                </label>
                <label for="cleangreen_checkbox" class="mb-3 items-center hidden">
                    <input type="checkbox" name="committee_roles[]" value="Clean and Green" class="mt-1 p-2 border border-gray-300 rounded-md" disabled>
                    <span class="ml-1">Clean And Green</span>
                </label>

                <label for="culturetourism_checkbox" class="mb-3 items-center hidden">
                    <input type="checkbox" name="committee_roles[]" value="Culture and Tourism" class="mt-1 p-2 border border-gray-300 rounded-md" disabled>
                    <span class="ml-1">Culture and Tourism</span>
                </label>
                <label for="drrmo_checkbox" class="mb-3 items-center hidden">
                    <input type="checkbox" name="committee_roles[]" value="DRRMO" class="mt-1 p-2 border border-gray-300 rounded-md" disabled>
                    <span class="ml-1">DRRMO</span>
                </label>
                <label for="ecology_checkbox" class="mb-3 items-center hidden">
                    <input type="checkbox" name="committee_roles[]" value="Ecology and Environment" class="mt-1 p-2 border border-gray-300 rounded-md" disabled>
                    <span class="ml-1">Ecology and Environment</span>
                </label>
                <label for="education_checkbox" class="mb-3 items-center hidden">
                    <input type="checkbox" name="committee_roles[]" value="Education"  class="mt-1 p-2 border border-gray-300 rounded-md" disabled>
                    <span class="ml-1">Education</span>
                </label>
                <label for="elderly_checkbox" class="mb-3 items-center hidden">
                    <input type="checkbox" name="committee_roles[]" value="Elderly's and PWD"  class="mt-1 p-2 border border-gray-300 rounded-md" disabled>
                    <span class="ml-1">Elderly's and PWD</span>
                </label>
                <label for="finance_checkbox" class="mb-3 items-center hidden">
                    <input type="checkbox" name="committee_roles[]" value="Finance and Appropriation"  class="mt-1 p-2 border border-gray-300 rounded-md" disabled>
                    <span class="ml-1">Finance and Appropriation</span>
                </label>
                <label for="health_checkbox" class="mb-3 items-center hidden">
                    <input type="checkbox" name="committee_roles[]" value="Health and Sanitation"  class="mt-1 p-2 border border-gray-300 rounded-md" disabled>
                    <span class="ml-1">Health and Sanitation</span>
                </label>
                <label for="infrastracture_checkbox" class="mb-3 items-center hidden">
                    <input type="checkbox" name="committee_roles[]" value="Infrastracture"  class="mt-1 p-2 border border-gray-300 rounded-md" disabled>
                    <span class="ml-1">Infrastracture</span>
                </label>
                <label for="law_checkbox" class="mb-3 items-center hidden">
                    <input type="checkbox" name="committee_roles[]" value="Laws and Ordinances/Human Rights"  class="mt-1 p-2 border border-gray-300 rounded-md" disabled>
                    <span class="ml-1">Laws and Ordinances/Human Rights</span>
                </label>
                <label for="livelihood_checkbox" class="mb-3 items-center hidden">
                    <input type="checkbox" name="committee_roles[]" value="Livelihood and Cooperative"  class="mt-1 p-2 border border-gray-300 rounded-md" disabled>
                    <span class="ml-1">Livelihood and Cooperative</span>
                </label>
                <label for="peace_checkbox" class="mb-3 items-center hidden">
                    <input type="checkbox" name="committee_roles[]" value="Peace and Order"  class="mt-1 p-2 border border-gray-300 rounded-md" disabled>
                    <span class="ml-1">Peace and Order</span>
                </label>
                <label for="purok_checkbox" class="mb-3 items-center hidden">
                    <input type="checkbox" name="committee_roles[]" value="Purok Affairs"  class="mt-1 p-2 border border-gray-300 rounded-md" disabled>
                    <span class="ml-1">Purok Affairs</span>
                </label>
                <label for="social_checkbox" class="mb-3 items-center hidden">
                    <input type="checkbox" name="committee_roles[]" value="Social Services"  class="mt-1 p-2 border border-gray-300 rounded-md" disabled>
                    <span class="ml-1">Social Services</span>
                </label>
                <label for="trade_checkbox" class="mb-3 items-center hidden">
                    <input type="checkbox" name="committee_roles[]" value="Trade, Commerce and Industry"  class="mt-1 p-2 border border-gray-300 rounded-md" disabled>
                    <span class="ml-1">Trade, Commerce and Industry</span>
                </label>
                <label for="transpo_checkbox" class="mb-3 items-center hidden">
                    <input type="checkbox" name="committee_roles[]" value="Transportation and Traffic" class="mt-1 p-2 border border-gray-300 rounded-md" disabled>
                    <span class="ml-1">Transportation and Traffic</span>
                </label>
                <label for="ways_checkbox" class="mb-3 items-center hidden">
                    <input type="checkbox" name="committee_roles[]" value="Ways and Means"  class="mt-1 p-2 border border-gray-300 rounded-md" disabled>
                    <span class="ml-1">Ways and Means</span>
                </label>
                <label for="women_checkbox" class="mb-3 items-center hidden">
                    <input type="checkbox" name="committee_roles[]" value="Women's and Family (Gender and Development)"  class="mt-1 p-2 border border-gray-300 rounded-md" disabled>
                    <span class="ml-1">Women's and Family (Gender and Development)</span>
                </label>
                <!-- Add more checkbox inputs as needed -->
            </div>
            <x-input-error :messages="$errors->get('committee_roles')" class="mt-2" />
        </div>
                    <!-- Other staff fields (age, address, email, phone) can be added similarly -->
    
                    <!-- Work Schedule Inputs -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-4">Work Schedule</label>
                        <div class="sm:grid-cols-2 gap-4">
                            <div>
                                <label for="day_of_week" class="block text-sm font-medium text-gray-700">Day of Week</label>
                                <input type="text" name="day_of_week" id="day_of_week" value="{{ $user->day_of_week }}" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                            </div>
                            <div>
                                <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
                                <input type="time" name="start_time" id="start_time" value="{{ $user->start_time }}" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                            </div>
                            <div>
                                <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
                                <input type="time" name="end_time" id="end_time" value="{{ $user->end_time }}" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                            </div>
                        </div>
                    </div>
    
                    <div class="col-span-2 m-auto">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Done</button>
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

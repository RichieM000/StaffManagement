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
            <h1 class="text-2xl font-semibold mb-4">Add New Task</h1>
            <a href="{{route('admin.task')}}" class="bg-button px-6 py-1 text-white rounded-md hover:bg-hover">Back</a>
        </div>

        <div class="container mx-auto mt-8">
            <form action="{{route('tasks-store')}}" method="POST" class="max-w-md mx-auto">
                @csrf
                <!-- Task Title -->
                <div class="mb-4 col-span-2">
                    <x-input-label for="jobrole" :value="__('Job Role')" />
                    <select name="job_roles[]" id="jobrole" class="mt-1 p-2 borderoverflow-y-auto border-gray-300 rounded-md w-full" required>
                        <option>--Select Job Role--</option>
                        <option name="job_roles[]" value="Chairman">Chairman</option>
                        <option name="job_roles[]" value="Secretary">Secretary</option>
                        <option name="job_roles[]" value="Treasurer">Treasurer</option>
                        <option name="job_roles[]" value="Kagawad">Kagawad</option>
                        <option name="job_roles[]" value="Tanod">Tanod</option>
                        <option name="job_roles[]" value="SKchairman">SK Chairman</option>
                        <option name="job_roles[]" value="SK">SK</option>
                        <option name="job_roles[]" value="Clerk">Clerk</option>
                        <option name="job_roles[]" value="BHW">Barangay Health Workers</option>
                        
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

                <div class="mb-4">
                    <label for="title" class="block font-medium text-sm text-gray-700">Task Title:</label>
                    <input type="text" name="title" id="title" class="mt-1 p-2 borderoverflow-y-auto border-gray-300 rounded-md w-full" required>
                </div>
        
                <!-- Task Description -->
                <div class="mb-4">
                    <label for="description" class="block font-medium text-sm text-gray-700">Task Description:</label>
                    <textarea name="description" id="description" rows="3" class="mt-1 p-2 borderoverflow-y-auto border-gray-300 rounded-md w-full" required></textarea>
                </div>

                 <!-- Task Deadline -->
                 <div class="mb-6">
                    <label for="deadline" class="block font-medium text-sm text-gray-700">Task Deadline:</label>
                    <input type="date" name="deadline" id="deadline" class="mt-1 p-2 borderoverflow-y-auto border-gray-300 rounded-md w-full" required>
                </div>

                <!-- Task Submission Button -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Task</button>
                </div>
                
            </form>
        </div>
        
    </div>
</x-app-layout>
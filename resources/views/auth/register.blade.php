<x-guest-layout>

    <p class="text-center px-4 pb-4 text-2xl font-medium">Register</p>
    
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="grid grid-cols-2 gap-3">
        <!-- Name -->
        <div>
            <x-input-label for="fname" :value="__('Firstname')" />
            <x-text-input id="fname" class="block mt-1 w-full capitalize" type="text" name="fname" :value="old('fname')" required autofocus autocomplete="fname" />
            <x-input-error :messages="$errors->get('fname')" class="mt-2" />
        </div>

         <!-- Lastname -->
         <div>
            <x-input-label for="lname" :value="__('Lastname')" />
            <x-text-input id="lname" class="block mt-1 w-full capitalize" type="text" name="lname" :value="old('lname')" required autofocus autocomplete="lname" />
            <x-input-error :messages="$errors->get('lname')" class="mt-2" />
        </div>

         <!-- Gender -->
         <div class="mb-4">
            <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
            <select name="gender" id="gender" class="mt-1 p-2 border border-gray-300 rounded-md w-full" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
        </div>

          <!-- Age -->
          <div>
            <x-input-label for="age" :value="__('Age')" />
            <x-text-input id="age" class="block mt-1 w-full capitalize" type="text" name="age" :value="old('age')" required autofocus autocomplete="age" />
            <x-input-error :messages="$errors->get('age')" class="mt-2" />
        </div>

         <!-- Address -->
         <div class="col-span-2">
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" class="block mt-1 w-full capitalize" type="text" name="address" :value="old('address')" required autofocus autocomplete="address" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input  id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div>
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" maxlength="11" class="block mt-1 w-full capitalize" type="tel" name="phone" :value="old('phone')" required autofocus autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Job Role -->
        <div class="col-span-2">
            <x-input-label for="jobrole" :value="__('Job Role')" />
            <select name="jobrole" id="jobrole" class="mt-1 p-2 borderoverflow-y-auto border-gray-300 rounded-md w-full" required>
                <option>--Select Job Role--</option>
                <option value="Chairman">Chairman</option>
                <option value="Secretary">Secretary</option>
                <option value="Treasurer">Treasurer</option>
                <option value="Kagawad">Kagawad</option>
                <option value="Tanod">Tanod</option>
                <option value="SKchairman">SK Chairman</option>
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
        
       
    


        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
    </div>

     {{-- Work Schedule --}}
     <div class="mt-8">
        <label class="block text-sm font-bold text-gray-700 mb-4">Work Schedule</label>
        <div class="sm:grid-cols-2 gap-4">
            <div>
                <label for="day_of_week" class="block text-sm font-medium text-gray-700">Day of Week</label>
                <select name="day_of_week" id="day_of_week" class="mt-1 p-2 border overflow-y-auto border-gray-300 rounded-md w-full" required>
                    <option value="Monday-Friday">Monday-Friday</option>
                    <option value="Monday-Saturday">Monday-Saturday</option>
                    <option value="Saturday-Sunday">Saturday-Sunday</option>
                   
                </select>
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

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

</x-guest-layout>

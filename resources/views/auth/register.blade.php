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
         <div>
            <x-input-label for="gender" :value="__('Gender')" />
            <x-text-input id="gender" class="block mt-1 w-full capitalize" type="text" name="gender" :value="old('gender')" required autofocus autocomplete="gender" />
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
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
            <x-input-label for="phone" :value="__('Job Role')" />
            <select name="jobrole" id="jobrole" class="mt-1 p-2 border overflow-y-auto border-gray-300 rounded-md w-full" required>
                <option value="Chairman">Chairman</option>
                <option value="Secretary">Secretary</option>
                <option value="Treasurer">Treasurer</option>
                <option value="Kagawad">Kagawad</option>
                <option value="Tanod">Tanod</option>
                <option value="SKchairman">SK Chairman</option>
                <option value="SK">SK</option>
                <option value="BHW">Barangay Health Workers</option>
            </select>
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
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

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            {{ __('Update Leave Request') }}
        </h2>
    </x-slot>

    <!-- Main content with sidebar -->
    <div class="flex">
        <x-user-sidebar /> <!-- Include the sidebar component -->
        <div class="flex-1 p-4">

            @if(session('success'))
            <div id="successMessage" class="bg-green-100 transition duration-300 ease-in-out border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        
            <script>
                // Automatically hide the success message after 5 seconds (5000 milliseconds)
                setTimeout(function() {
                    document.getElementById('successMessage').style.display = 'none';
                }, 3000); // Adjust the timeout value as needed (in milliseconds)
            </script>
            @endif

            <div class="container py-16 max-w-2xl m-auto relative mt-8">
                <a href="{{route('user.leave')}}" class="bg-button px-6 py-1 absolute top-0 right-0 mr-4 mb-8 text-white rounded-md hover:bg-hover">Back</a>
                <form action="/leave/{{$leaveRequest->id}}/update" method="POST" class="max-w-md mx-auto">

                    @csrf
                    @method('PUT')
                    <!-- Task Title -->
                   
                   
    
                    {{-- <div class="mb-4">
                        <label for="fname" class="block font-medium text-sm text-gray-700">Firstname</label>
                        <input type="text" name="fname" id="fname" class="mt-1 p-2 borderoverflow-y-auto border-gray-300 rounded-md w-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="lname" class="block font-medium text-sm text-gray-700">Lastname</label>
                        <input type="text" name="lname" id="lname" class="mt-1 p-2 borderoverflow-y-auto border-gray-300 rounded-md w-full" required>
                    </div> --}}
                    <div class="mb-4 col-span-2">
                        <x-input-label for="leave_type" :value="__('Type of Leave')" />
                        <select name="leave_type" id="leave_type" value="{{ old('leave_type', $leaveRequest->leave_type) }}" class="mt-1 p-2 borderoverflow-y-auto border-gray-300 rounded-md w-full" required>
                            {{-- <option class="opacity-5">--Select Type Of Leave--</option> --}}
                            <option value="Paternity Leave">Paternity Leave</option>
                            <option value="Maternity Leave">Maternity Leave</option>
                            <option value="Casual Leave">Casual Leave</option>
                            <option value="Sick Leave">Sick Leave</option>
                            <option value="Annual Leave">Annual Leave</option>
                        </select>
                        </div>
                             

                        <div class="grid grid-cols-2 gap-3">
                     <div class="mb-6">
                        <label for="deadline" class="block font-medium text-sm text-gray-700">Start Date:</label>
                        <input type="date" name="start_date" value="{{ old('start_date', $leaveRequest->start_date) }}" id="deadline" class="mt-1 p-2 borderoverflow-y-auto border-gray-300 rounded-md w-full" required>
                    </div>

                    <div class="mb-6">
                        <label for="deadline" class="block font-medium text-sm text-gray-700">End Date:</label>
                        <input type="date" name="end_date" id="deadline" value="{{ old('end_date', $leaveRequest->end_date) }}" class="mt-1 p-2 borderoverflow-y-auto border-gray-300 rounded-md w-full" required>
                    </div>
                </div>
                   
                    <!-- Task Description -->
                    <div class="mb-4">
                        <label for="reason" class="block font-medium text-sm text-gray-700">Leave Reason:</label>
                        <textarea name="reason" id="reason" rows="3" class="mt-1 p-2 borderoverflow-y-auto border-gray-300 rounded-md w-full" require>{{ old('reason', $leaveRequest->reason)}}</textarea>
                    </div>
    
                    
                    <!-- Task Submission Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
                    </div>
                    
                </form>
            </div>
            
     

  
</div>
    </div>
</x-app-layout>
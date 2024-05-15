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
                <form action="/leave/{{ $leaveRequest->id }}/update" method="POST" class="max-w-md mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    @csrf
                    @method('PUT')
                
                    <!-- Type of Leave -->
                    <div class="mb-4">
                        <label for="leave_type" class="block text-sm font-medium text-gray-700">Type of Leave:</label>
                        <select name="leave_type" id="leave_type" class="form-select block w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                            <option value="Paternity Leave" {{ old('leave_type', $leaveRequest->leave_type) === 'Paternity Leave' ? 'selected' : '' }}>Paternity Leave</option>
                            <option value="Maternity Leave" {{ old('leave_type', $leaveRequest->leave_type) === 'Maternity Leave' ? 'selected' : '' }}>Maternity Leave</option>
                            <option value="Casual Leave" {{ old('leave_type', $leaveRequest->leave_type) === 'Casual Leave' ? 'selected' : '' }}>Casual Leave</option>
                            <option value="Sick Leave" {{ old('leave_type', $leaveRequest->leave_type) === 'Sick Leave' ? 'selected' : '' }}>Sick Leave</option>
                            <option value="Annual Leave" {{ old('leave_type', $leaveRequest->leave_type) === 'Annual Leave' ? 'selected' : '' }}>Annual Leave</option>
                        </select>
                    </div>
                
                    <!-- Start and End Date -->
                    <div class="grid grid-cols-2 gap-3 mb-6">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date:</label>
                            <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $leaveRequest->start_date) }}" class="form-input block w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date:</label>
                            <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $leaveRequest->end_date) }}" class="form-input block w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                        </div>
                    </div>
                
                    <!-- Leave Reason -->
                    <div class="mb-4">
                        <label for="reason" class="block text-sm font-medium text-gray-700">Leave Reason:</label>
                        <textarea name="reason" id="reason" rows="3" class="form-textarea block w-full mt-1 p-2 border border-gray-300 rounded-md" required>{{ old('reason', $leaveRequest->reason) }}</textarea>
                    </div>
                
                    <!-- Submission Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
                    </div>
                </form>
                
            </div>
            
     

  
</div>
    </div>
</x-app-layout>
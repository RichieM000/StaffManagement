<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            {{ __('File Leave') }}
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

            <div class="container mt-8">
                <form action="/leave/{{$user->id}}/fileleave" method="POST" class="max-w-md mx-auto">
                    @csrf
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
                        <select name="leave_type" id="leave_type" class="mt-1 p-2 borderoverflow-y-auto border-gray-300 rounded-md w-full" required>
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
                        <input type="date" name="start_date" id="deadline" class="mt-1 p-2 borderoverflow-y-auto border-gray-300 rounded-md w-full" required>
                    </div>

                    <div class="mb-6">
                        <label for="deadline" class="block font-medium text-sm text-gray-700">End Date:</label>
                        <input type="date" name="end_date" id="deadline" class="mt-1 p-2 borderoverflow-y-auto border-gray-300 rounded-md w-full" required>
                    </div>
                </div>
                   
                    <!-- Task Description -->
                    <div class="mb-4">
                        <label for="reason" class="block font-medium text-sm text-gray-700">Leave Reason:</label>
                        <textarea name="reason" id="reason" rows="3" class="mt-1 p-2 borderoverflow-y-auto border-gray-300 rounded-md w-full" required></textarea>
                    </div>
    
                    
                    <!-- Task Submission Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create</button>
                    </div>
                    
                </form>
            </div>
            
    
    


            <div class="container mx-auto px-4 py-8">
                <h1 class="text-2xl font-bold mb-4">Submitted Leave Request</h1>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4 p-4">
                    @php
                        $currentUser = Auth::user();
                    @endphp
                    @foreach( $leaveRequests->where('user_id', $currentUser->id) as $leaveRequest)
                    <div class="bg-blue-50 flex justify-between p-4 rounded-lg shadow-md mb-4 transition duration-300 ease-in-out hover:bg-blue-200">
                        <div>
                            <div class="text-xl font-semibold text-blue-900">{{ $leaveRequest->leave_type }}</div>
                            {{-- <div class="text-gray-700">{{ $leaveRequest->reason }}</div> --}}
                            <div class="text-sm text-gray-600">Job Role: {{ $leaveRequest->user->jobrole }}</div>
                            {{-- <div class="text-sm text-gray-600">Committee On: {{ $task->kagawad_committee_on }}</div> --}}
                            <div class="text-sm text-gray-600">Start Date: {{ \Carbon\Carbon::parse($leaveRequest->start_date)->format('Y-m-d') }}</div>
                            <div class="text-sm text-gray-600">End Date: {{ \Carbon\Carbon::parse($leaveRequest->end_date)->format('Y-m-d') }}</div>
                        </div>
                        <div class="mt-4 grid grid-cols-1 items-center">
                            @if($leaveRequest->status === 'approved')
                            <div class="text-base text-green-600">Status: {{ ucfirst($leaveRequest->status) }}</div>
                            @elseif($leaveRequest->status === 'rejected')
                            <div class="text-base text-red-600">Status: {{ ucfirst($leaveRequest->status) }}</div>
                            @else
                            <div class="text-base text-gray-600">Status: {{ ucfirst($leaveRequest->status) }}</div>
                            @endif
                        </div>
                    </div>
                @endforeach
                
                
                </div>
    
        </div>

  
</div>
    </div>
</x-app-layout>
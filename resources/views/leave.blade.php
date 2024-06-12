<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            {{ __('File Leave') }}
        </h2>
    </x-slot>

    <!-- Main content with sidebar -->
    <div class="flex">
        <x-user-sidebar /> <!-- Include the sidebar component -->
        <div class="flex-1 p-4 overflow-y-auto">

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
                <form action="/leave/{{ $user->id }}/fileleave" method="POST" class="max-w-md mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    @csrf
                
                    <!-- Type of Leave -->
                    <div class="mb-4">
                        <label for="leave_type" class="block text-sm font-medium text-gray-700">Type of Leave:</label>
                        <select name="leave_type" id="leave_type" class="form-select block w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                            @if (Auth::user()->gender == 'female')
                                <option value="Maternity Leave">Maternity Leave</option>
                             @endif

                             @if (Auth::user()->gender == 'male')
                            <option value="Paternity Leave">Paternity Leave</option>
                            @endif
                            <option value="Casual Leave">Casual Leave</option>
                            <option value="Sick Leave">Sick Leave</option>
                            <option value="Annual Leave">Annual Leave</option>
                        </select>
                    </div>
                
                    <!-- Start and End Date -->
                    <div class="grid grid-cols-2 gap-3 mb-6">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date:</label>
                            <input type="date" name="start_date" id="start_date" class="form-input block w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date:</label>
                            <input type="date" name="end_date" id="end_date" class="form-input block w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                        </div>
                    </div>
                
                    <!-- Leave Reason -->
                    <div class="mb-4">
                        <label for="reason" class="block text-sm font-medium text-gray-700">Leave Reason:</label>
                        <textarea name="reason" id="reason" rows="3" class="form-textarea block w-full mt-1 p-2 border border-gray-300 rounded-md" required></textarea>
                    </div>
                
                    <!-- Submission Button -->
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
                            <div class="text-sm text-gray-600">Start Date: {{ \Carbon\Carbon::parse($leaveRequest->start_date)->format('F j, Y') }}</div>
                            <div class="text-sm text-gray-600">End Date: {{ \Carbon\Carbon::parse($leaveRequest->end_date)->format('F j, Y') }}</div>
                        </div>
                        <div class="mt-4 grid grid-cols-1 items-center">
                            @if($leaveRequest->status === 'approved')
                            <div class="text-base text-green-600">Status: {{ ucfirst($leaveRequest->status) }}</div>
                            @elseif($leaveRequest->status === 'rejected')
                            <div class="text-base text-red-600">Status: {{ ucfirst($leaveRequest->status) }}</div>
                            <form action="/leave/{{$leaveRequest->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                            <button onclick="return confirm('Are you sure you want to delete this leave request?')" class="bg-button mt-2 py-2 px-8 rounded-md text-center text-red-500 text-xl hover:bg-hover"><i class="ri-delete-bin-fill"></i></button>
                        </form>
                            @else
                            <div class="text-base text-gray-600">Status: {{ ucfirst($leaveRequest->status) }}</div>
                            <a href="/leave/{{$leaveRequest->id}}/edit" class="bg-button mt-2 py-1.5 rounded-md text-center text-white hover:bg-hover"><i class="ri-edit-fill"></i></a>
                            @endif
                            
                        </div>
                    </div>
                @endforeach
                
                
                </div>
    
        </div>

  
</div>
    </div>
</x-app-layout>
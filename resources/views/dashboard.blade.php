<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            {{ __('Staff Dashboard') }}
        </h2>
    </x-slot>

    <!-- Main content with sidebar -->
    <div class="flex">
        <x-user-sidebar /> <!-- Include the sidebar component -->

        <div class="flex-1 p-4 overflow-y-auto">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 font-bold text-xl dark:text-gray-100">
                        Welcome <span class="text-button capitalize">{{ Auth::user()->fname }}</span> 
                    </div>
                </div>
            </div>

        
            <div class="mx-auto px-4 py-8">
                {{-- <div class="bg-white rounded-lg max-w-lg mx-auto shadow-md mb-4 p-4">
                    <div id='calendar'></div>
                </div> --}}

                <div class="grid grid-cols-4 mx-auto w-11/12 items-start gap-4">

                <div class="bg-white h-auto shadow-sm sm:rounded-lg mb-4 p-4">
                    <div class="text-lg font-bold mb-2">Attendance & Time Tracking</div>
                    {{-- @if(session('success'))
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
                    @endif --}}
                    <div class="flex justify-between">
                    <div class="mb-4">
                        <div class="text-gray-600 font-semibold mb-2">Current Date:</div>
                        <p id="currentDate"></p>
                    </div>
                    
                        <div class="mb-4">
                            <div class="text-gray-600 font-semibold mb-2">Current Time:</div>
                            <p id="currentTime"></p>
                        </div>
                    </div>
                        {{-- <div>
                            <p id="timeTracking">Time tracked: 00:00:00</p>
                        </div> --}}
                <div class="flex justify-center">
                    @if($showTimeIn)
                        <form id="timeInForm" action="{{ route('clock.in') }}" method="POST">
                            @csrf
                            <button type="submit" id="timeInBtn" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded focus:outline-none">
                                Time In
                            </button>
                        </form>
                    @elseif($showTimeOut)
                        <form id="timeOutForm" action="{{ route('clock.out') }}" method="POST">
                            @csrf
                            <button type="submit" id="timeOutBtn" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded focus:outline-none">
                                Time Out
                            </button>
                        </form>
                    @else
                        <button type="button" id="timeInButton" class="bg-gray-500 cursor-not-allowed hover:bg-gray-600 text-white py-2 px-4 rounded focus:outline-none" disabled>
                            Time In
                        </button>
                    @endif
                </div>
            </div>
               
           
                
              
              
                    <div class="bg-white rounded-lg shadow-md p-6">
 
                        <div class="text-3xl font-semibold text-gray-800">{{ $pendingTasksCount }}</div>
                        
                        <div class="text-xl font-base text-gray-900">Pending Tasks</div>
                    </div>

                  
               
        
        
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold mb-4">Your Leave Request Count</h2>
                        <ul class="bg-green-500 text-white p-2 rounded-lg">
                            @foreach($leaveCounts as $leaveCount)
                                <li class="flex justify-between">
                                    <div> {{ ucfirst($leaveCount->status) }}</div>
                                    <div class="text-lg ">{{ $leaveCount->count }}</div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>


        </div>
    </div>
</x-app-layout>

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
            {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 font-bold text-xl dark:text-gray-100">
                        Welcome <span class="text-button capitalize">{{ Auth::user()->fname }}</span> 
                    </div>
                </div>
            </div> --}}
            
           
            @if($pendingTasksCount > 0)
            <div id="successMessage" class="" role="alert">
                <div class="">
                    <span><i class="ri-notification-4-fill"></i></span>
                <strong class="text-green-500 font-bold">Pending Task!</strong>
                </div>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="document.getElementById('successMessage').style.display = 'none';" role="button"><i class="ri-close-fill"></i></span>
            
                {{-- <span class="block sm:inline">{{ session('success') }}</span> --}}
            </div>
           
            <script>
                // Automatically hide the success message after 5 seconds (5000 milliseconds)
                setTimeout(function() {
                    document.getElementById('successMessage').classList.add('hidden');
                }, 3000); // Adjust the timeout value as needed (in milliseconds)
            </script>
            @endif


            @if($performancecount > 0)
            <div id="Message1" class="" role="alert">
                <div class="">
                    <span><i class="ri-notification-4-fill"></i></span>
                <strong class="text-green-500 font-bold">You receive an evaluation!</strong>
                </div>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="document.getElementById('successMessage').style.display = 'none';" role="button"><i class="ri-close-fill"></i></span>
            
                {{-- <span class="block sm:inline">{{ session('success') }}</span> --}}
            </div>
            <script>
                // Automatically hide the success message after 5 seconds (5000 milliseconds)
                setTimeout(function() {
                    document.getElementById('Message1').classList.add('hidden');
                }, 3000); // Adjust the timeout value as needed (in milliseconds)
            </script>
            @endif
        
            <div class="mx-auto bg-white mt-12 grid grid-cols-3 gap-2 w-11/12 items-start px-4 py-8">
                {{-- <div class="bg-white rounded-lg max-w-lg mx-auto shadow-md mb-4 p-4">
                    <div id='calendar'></div>
                </div> --}}

                

                <div class=" sm:rounded-lg mb-4 p-4">
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
                    @if($showTimeIn && ($enableTimeInMorning || $enableTimeInAfternoon))
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
                <a class="" href=" {{route('user.evaluation') }}">
                <div class="mt-12 transition duration-300 ease-in-out hover:bg-gray-200 p-4 rounded-lg">
                    <h1 class="mb-2 font-semibold">Performance Evaluation:</h1>

                    <div class="bg-blue-500 text-white p-4 rounded-md transition duration-300 ease-in-out {{ $performancecount > 0? 'animate-pulse scale-105 hover:scale-110' : '' }}">
                    <div class="text-3xl font-semibold">{{ $performancecount }}</div>
                    <div class="text-xl font-bold">Evaluations</div>
                </div>
                </div>
            </a>
            </div>
               
           
                
              
              <a href="{{ route('user.task') }}">
            <div class=" transition duration-300 ease-in-out hover:bg-gray-200 rounded-lg p-6 grid grid-cols-2 gap-3">
                <div class="col-span-2">
                    <div class="text-3xl font-semibold text-gray-800">{{ $overallTasks }}</div>
                
                     <div class="text-xl font-bold text-gray-900">Overall Tasks</div>
                </div>

                <div class="bg-gray-500 rounded p-1.5 transition duration-300 ease-in-out {{ $pendingTasksCount > 0? 'animate-pulse scale-105 hover:scale-110' : '' }}">
                    <div class="text-3xl font-semibold text-white">{{ $pendingTasksCount }}</div>
                    <div class="text-xl font-base text-white">Pending Tasks</div>
                </div>

            <div class="bg-blue-500 rounded p-1.5">
                <div class="text-3xl font-semibold text-white">{{ $progressTasksCount }}</div>
                
                <div class="text-xl font-base text-white">In Progress Tasks</div>
            </div>

            <div class="bg-red-500 rounded p-1.5">
                <div class="text-3xl font-semibold text-white">{{ $rejectedTasksCount }}</div>
                
                <div class="text-xl font-base text-white">Rejected Tasks</div>
            </div>

            <div class="bg-green-500 rounded p-1.5">
                <div class="text-3xl font-semibold text-white">{{ $completeTasksCount }}</div>
                
                <div class="text-xl font-base text-white">Completed Tasks</div>
            </div>

            <div class ="bg-red-200 rounded p-1.5 col-span-2 transition duration-300 ease-in-out {{ $deadlinecount > 0? 'animate-pulse  hover:scale-110' : '' }}">
                <div class="text-3xl font-semibold text-red-600">{{ $deadlinecount }}</div>
                
                <div class="text-xl font-base text-red-500">Exceeded deadline tasks</div>
            </div>
            </div>
        </a>

          <a href="{{ route('user.leave') }}">
            <div class="transition duration-300 ease-in-out hover:bg-gray-200 rounded-lg p-6 grid grid-cols-2 gap-3">
                <div class="col-span-2">
                    <div class="text-3xl font-semibold text-gray-800">{{ $overallLeave }}</div>
                
                     <div class="text-xl font-bold text-gray-900">Overall Leaves</div>
                </div>

                <div class="bg-gray-500 rounded p-1.5">
                <div class="text-3xl font-semibold text-white">{{ $pendingleaveCount }}</div>
                
                <div class="text-xl font-base text-white">Pending Leaves</div>
            </div>

            <div class="bg-blue-500 rounded p-1.5 transition duration-300 ease-in-out {{ $approvedleaveCount > 0? 'animate-pulse hover:scale-110' : '' }}">
                <div class="text-3xl font-semibold text-white">{{ $approvedleaveCount }}</div>
                
                <div class="text-xl font-base text-white">Approved Leaves</div>
            </div>

            <div class="bg-red-500 rounded p-1.5 transition duration-300 ease-in-out {{ $rejectedleaveCount > 0? 'animate-pulse hover:scale-110' : '' }}">
                <div class="text-3xl font-semibold text-white">{{ $rejectedleaveCount }}</div>
                
                <div class="text-xl font-base text-white">Rejected Leaves</div>
            </div>

            </div>
        </a>

                
            </div>
        </div>
    </div>
</x-app-layout>

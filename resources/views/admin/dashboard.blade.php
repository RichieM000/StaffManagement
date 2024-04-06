{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}


<!-- resources/views/dashboard.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <!-- Main content with sidebar -->
    <div class="flex">
        <x-sidebar /> <!-- Include the sidebar component -->

        <div class="flex-1 p-4">

            
            
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div id="successMessage" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            {{ __('Your are Logged In!') }}
                        </div>
                    </div>
                </div>
        
       

         

     <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-2 gap-2 mt-16">
                 <!-- Overall Users -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4 p-4">
        <div class="flex items-center">
            <div class="flex-shrink-0 h-12 w-12 bg-blue-500 text-white rounded-full flex items-center justify-center">
                <i class="ri-user-line text-2xl"></i>
            </div>
            <div class="ml-4">
                <div class="text-lg font-medium text-gray-900">Overall Users</div>
                <div class="text-3xl font-semibold text-gray-800">{{ $overallUsersCount }}</div>
            </div>
        </div>
    </div>

   

    <!-- Overall Tasks -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4 p-4">
        <div class="text-lg font-medium text-gray-900 mb-2">Task Statistics</div>
        <div class="grid grid-cols-2 gap-4">
            <div class="bg-blue-50 p-4 rounded-lg shadow-md">
                <div class="text-xl font-semibold text-blue-900">Overall Tasks</div>
                <div class="text-3xl font-semibold text-blue-800">{{ $overallTasksCount }}</div>
            </div>
            <div class="bg-red-50 p-4 rounded-lg shadow-md">
                <div class="text-xl font-semibold text-red-900">Rejected Tasks</div>
                <div class="text-3xl font-semibold text-red-800">{{ $rejectedTasksCount }}</div>
            </div>
            <!-- Add more task statistics as needed -->
        </div>
    </div>

 <!-- Users By Jobrole -->
 <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4 p-4">
    <div class="text-lg font-medium text-gray-900 mb-2">Job Positions</div>
    <div class="grid grid-cols-2 gap-4">
        @foreach($usersByJobrole as $jobrole)
            <div class="bg-blue-50 p-4 rounded-lg shadow-md">
                <div class="text-xl font-semibold text-blue-900">{{ $jobrole->jobrole }}</div>
                <div class="text-3xl font-semibold text-blue-800">{{ $jobrole->count }}</div>
            </div>
        @endforeach
    </div>
</div>


</div>





        </div>
    </div>
</x-app-layout>

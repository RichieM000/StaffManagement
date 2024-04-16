<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            {{ __('Staff Dashboard') }}
        </h2>
    </x-slot>

    <!-- Main content with sidebar -->
    <div class="flex">
        <x-user-sidebar /> <!-- Include the sidebar component -->

        <div class="flex-1 p-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 font-bold text-xl dark:text-gray-100">
                        Welcome <span class="text-button capitalize">{{ Auth::user()->fname }}</span> 
                    </div>
                </div>
            </div>

        
            <div class="container mx-auto px-4 py-8">
              
        
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold mb-4">Your Task Count</h2>
                        <ul class="bg-blue-400 text-white p-2 rounded-lg">
                            @foreach($taskCounts as $taskCount)
                                <li class="flex justify-between">
                                    <span>{{ ucfirst($taskCount->status) }}</span>
                                    <span class="text-lg">{{ $taskCount->count }}</span>
                                </li>
                            @endforeach
                        </ul>
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

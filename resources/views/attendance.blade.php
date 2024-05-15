<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            {{ __('Timesheet') }}
        </h2>
    </x-slot>

    <!-- Main content with sidebar -->
    <div class="flex">
        <x-user-sidebar /> <!-- Include the sidebar component -->
        <div class="flex-1 p-4">

            <div class="bg-white transition duration-300 ease-in-out shadow-md mt-4 rounded-lg overflow-x-auto">
                <div class="overflow-x-auto">
                    <table class="w-full table-auto" id="staffTable">
                        <!-- Table headers -->
                        <thead>
                            <tr class="bg-gray-200 text-gray-700 uppercase text-sm font-medium leading-normal">
                                <!-- Existing headers -->
                                <th class="px-4 py-2 whitespace-nowrap">No.</th>
                                <th class="px-4 py-2 whitespace-nowrap">Clock In</th>
                                <th class="px-4 py-2 whitespace-nowrap">Clock Out</th>
                                <th class="px-4 py-2 whitespace-nowrap">Date</th>
                                
                               
                               
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @php $counter = 1 @endphp
                            @foreach($attendances as $attendance)
                            <tr class="border-b border-gray-200 transition duration-300 ease-in-out text-center hover:bg-gray-100">
                                <td class="px-4 py-2">{{ $counter++ }}.</td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($attendance->clock_in)->format('h:i A') }}</td>
                                <td class="px-4 py-2">
                                    @if($attendance->clock_out)
                                        {{ \Carbon\Carbon::parse($attendance->clock_out)->format('h:i A') }}
                                    @endif
                                </td>
                                <td class="px-4 py-2">{{ $attendance->date }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
            
         

  
</div>
    </div>
</x-app-layout>
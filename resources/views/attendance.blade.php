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

            @if(session('delete'))
            <div id="deleteMessage" class="bg-red-100 transition duration-300 ease-in-out border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Delete Success!</strong>
                <span class="block sm:inline">{{ session('delete') }}</span>
            </div>
        
            <script>
                // Automatically hide the success message after 5 seconds (5000 milliseconds)
                setTimeout(function() {
                    document.getElementById('deleteMessage').style.display = 'none';
                }, 3000); // Adjust the timeout value as needed (in milliseconds)
            </script>
            @endif





        <div class="bg-white transition duration-300 ease-in-out shadow-md mt-4 rounded-lg overflow-x-auto">
            <div class="overflow-x-auto w-full p-4">
                <table class="responsive border-x-2" id="Table">
                    <!-- Table headers -->
                    <thead class="bg-gray-800 text-white">
                        <tr class="uppercase text-sm font-medium leading-normal">
                            <!-- Existing headers -->
                            <th style="text-align: left" class="px-4 py-2 whitespace-nowrap">#</th>
                            <th class="px-4 py-2 whitespace-nowrap">Clock In</th>
                            <th class="px-4 py-2 whitespace-nowrap">Clock Out</th>
                            <th style="text-align: left">Date</th>
                            <th style="text-align: left">Action</th>
                           
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-semibold">
                        @php $counter = 1 @endphp
                        @foreach($attendances as $attendance)
                        <tr class="border-b border-gray-200 transition duration-300 ease-in-out text-center hover:bg-gray-100">
                            <td style="text-align: left">{{ $counter++ }}.</td>
                            <td style="text-align: left">{{ \Carbon\Carbon::parse($attendance->clock_in)->format('h:i A') }}</td>
                            <td style="text-align: left">
                                @if($attendance->clock_out)
                                    {{ \Carbon\Carbon::parse($attendance->clock_out)->format('h:i A') }}
                                @endif
                            </td>
                            <td style="text-align: left">{{ $attendance->date }}</td>

                            <td>
                                <form action="/timesheet/delete{{$attendance->id}}" method="POST">
                                   @csrf
                                   @method('DELETE')
                                   <button type="submit" onclick="return confirm('Are you sure you want to delete this task assignment?')" class="text-red-500 text-xl hover:text-red-700"><i class="ri-delete-bin-fill"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                     
                    </tbody>
                </table>
                <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
                <script src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>
                <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
                <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
                <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
                <script>
                    new DataTable('#Table', {
                        responsive: true,
                                layout: {
                                    topStart: {
                                        buttons: ['copy', 'csv', 'excel', 'print']
                                    }
                                }
                            });
                </script>
            </div>
        </div>



    </div>

    </div>
</x-app-layout>
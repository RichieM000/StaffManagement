<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            {{ __('Evaluation') }}
        </h2>
    </x-slot>

    <!-- Main content with sidebar -->
    <div class="flex">
        <x-user-sidebar /> <!-- Include the sidebar component -->
        <div class="flex-1 p-4">

            <div class="bg-white transition duration-300 ease-in-out shadow-md mt-4 rounded-lg overflow-x-auto">
                <div class="overflow-x-auto w-full p-4">
                    <table class="responsive border-x-2" id="evalTable">
                        <!-- Table headers -->
                        <thead class="bg-gray-800 text-white">
                            <tr class="uppercase text-sm font-medium leading-normal">
                                <!-- Existing headers -->
                                <th style="text-align: left" class="px-4 py-2 whitespace-nowrap">#</th>
                                <th class="px-4 py-2 whitespace-nowrap">Name</th>
                                <th class="px-4 py-2 whitespace-nowrap">Task Assigned</th>
                                <th class="px-4 py-2 whitespace-nowrap">Attendance Tracking</th>
                                <th class="px-4 py-2 whitespace-nowrap">Feedback</th>
                                <th style="text-align: left" class="px-4 py-2 whitespace-nowrap">Performance Average</th>
                                
                               
            
            
            
            
                                {{-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th> --}}
                                
                                
                                <th style="text-align: center" class="py-3 px-6 whitespace-nowrap">Action</th>
                                <!-- New header for Assign Task button -->
                               
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-semibold">
                            @php $counter = 1 @endphp
                            @foreach($evaluations as $evaluation)
                            <tr class="capitalize text-sm font-medium leading-normal border-b border-gray-200 transition duration-300 ease-in-out hover:bg-gray-100">
                                <td style="text-align: left" class="px-4 py-2 whitespace-nowrap">{{$counter++}}.</td>
                            <td class="px-4 py-2 whitespace-nowrap">{{ $evaluation->user->fname }} {{ $evaluation->user->lname }}</td>
                            <td class="px-4 py-2 whitespace-nowrap">{{ $evaluation->task->title }}</td>
                            <td class="px-4 py-2 whitespace-nowrap"><a class="bg-button p-1 rounded text-white" href="">Check Attendance</a></td>
                            <td class="px-4 py-2 whitespace-nowrap">{{ $evaluation->feedback }}</td>
                            <td style="text-align: left" class="px-4 py-2 whitespace-nowrap">{{ $evaluation->total_average }}%</td>
            
                            <td class="py-3 px-6 whitespace-nowrap flex justify-center gap-2">
                                <div>
                                    <a class="text-white bg-green-500 py-1 px-2 rounded-md cursor-pointer hover:bg-green-700 open-modal-btn" data-id="{{ $evaluation->id }}">View</a>
                                </div>
                                
                                {{-- <form action="/destroy{{$evaluation->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this evaluation?')" class="text-red-500 text-xl hover:text-red-700"><i class="ri-delete-bin-fill"></i></button>
                                </form> --}}
                                
                            </td>
                            
                        </tr>
                        @endforeach
                            
                         
                        </tbody>
                    </table>

                    <div id="myModal" class="fixed flex inset-0 items-center justify-center bg-gray-800 bg-opacity-50 hidden">
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-3/4 md:w-1/2 lg:w-1/3 p-6 relative">
                            <button class="absolute top-3 right-3 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition duration-300 ease-in-out" id="close">&#10006;</button>
                            <p class="text-gray-900 text-center font-bold text-xl dark:text-gray-100 mb-8">Overview</p>
                            <div id="modalContent">
                            <div class="grid grid-cols-2 gap-2">
                                <div class="flex flex-col gap-4">
            
                                <div>
                                    <h3 class="font-semibold underline underline-offset-4 decoration-green-500 decoration-2">Staff Name</h3>
                                    <p id="staffName"></p>
                                </div>
                                <div>
                                    <h3 class="font-semibold underline underline-offset-4 decoration-green-500 decoration-2">Task Title</h3>
                                    <p id="taskTitle"></p>
                                </div>
                                <div>
                                    <h3 class="font-semibold underline underline-offset-4 decoration-green-500 decoration-2">Feedback</h3>
                                    <p id="feedback"></p>
                                </div>
                                <div>
                                    <h3 class="font-semibold underline underline-offset-4 decoration-green-500 decoration-2">Date Evaluated</h3>
                                    <p id="date"></p>
                                </div>
            
                                </div>
                                
                             <div>
                                    <h2 class="font-semibold mb-4 text-lg">Ratings</h2>
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <h3 class="font-semibold underline underline-offset-4 decoration-green-500 decoration-2">Efficiency</h3>
                                        <p class="" id="efficiency"></p>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold underline underline-offset-4 decoration-green-500 decoration-2">Quality</h3>
                                        <p id="quality"></p>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold underline underline-offset-4 decoration-green-500 decoration-2">Timeliness</h3>
                                        <p id="timeliness"></p>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold underline underline-offset-4 decoration-green-500 decoration-2">Accuracy</h3>
                                        <p id="accuracy"></p>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold underline underline-offset-4 decoration-green-500 decoration-2">Tardiness</h3>
                                        <p id="tardiness"></p>
                                    </div>
                                   
                                </div>
                                <div class="text-center">
                                    <h3 class="font-semibold underline underline-offset-4 decoration-green-500 decoration-2">Performance Average</h3>
                                    <p id="performanceAverage"></p>
                                </div>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>


                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    <script>
                    $(document).ready(function() {
                        const modal = $('#myModal');
                        const modalContent = $('#modalContent');
                        const closeBtn = $('#close');
                    
                        $('.open-modal-btn').on('click', function() {
                            const evaluationId = $(this).data('id');
                            openModal(evaluationId);
                        });
                    
                        closeBtn.on('click', function() {
                            closeModal();
                        });
                    
                        function openModal(evaluationId) {
                            $.ajax({
                                url: '/view/evaluation/' + evaluationId,
                                method: 'GET',
                                dataType: 'json',
                                success: function(data) {
                                    modalContent.find('#staffName').text(data.staffName);
                            modalContent.find('#taskTitle').text(data.taskTitle);
                            modalContent.find('#feedback').text(data.feedback);
                            modalContent.find('#efficiency').text(data.efficiency);
                            modalContent.find('#quality').text(data.quality);
                            modalContent.find('#timeliness').text(data.timeliness);
                            modalContent.find('#accuracy').text(data.accuracy);
                            modalContent.find('#tardiness').text(data.tardiness);
                            modalContent.find('#performanceAverage').text(data.performanceAverage + '%');
                            modalContent.find('#date').text(data.date);
                            modal.removeClass('hidden');
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error fetching data:', error);
                                }
                            });
                        }
                    
                        function closeModal() {
                            modal.addClass('hidden');
                        }
                    });
                    
                    </script>
                    
                </div>
            </div>
            
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
                new DataTable('#evalTable', {
                    responsive: true,
                            layout: {
                                topStart: {
                                    buttons: ['print']
                                }
                            }
                        });
            </script>

  
</div>
    </div>
</x-app-layout>
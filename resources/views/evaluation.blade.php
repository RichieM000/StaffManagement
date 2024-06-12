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
            <div class="grid md:grid-cols-4 gap-2">
            @foreach($evaluations as $evaluation)
            <div class="bg-white transition duration-300 ease-in-out shadow-md mt-4 rounded-lg p-4 m-2">
               
               <h1 class="text-xl mb-2 font-bold">{{ \Carbon\Carbon::parse($evaluation->created_at)->format('F j, Y') }}</h1>
               <p class="font-semibold">Task Title: {{ $evaluation->task->title }}</p>
               <p class="font-semibold">Feedback: {{ $evaluation->feedback }}</p>

               <div class="text-center mt-2">

                <p class="font-bold text-lg">Overall Average</p>
                <div class="text-lg font-semibold">{{$evaluation->total_average}}</div>
                <button class="mt-4 py-1.5 px-2 rounded-md bg-green-500 text-white hover:bg-green-700 open-modal-btn" data-id="{{ $evaluation->id }}">Overview</button>
               
            </div>
               
            </div>
            @endforeach
        </div>

        <div id="myModal" class="fixed flex inset-0 items-center justify-center bg-gray-800 bg-opacity-50 hidden">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-3/4 md:w-1/2 lg:w-1/3 p-6 relative">
                <button class="absolute top-3 right-3 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition duration-300 ease-in-out" id="close">&#10006;</button>
                <p class="text-gray-900 text-center font-bold text-xl dark:text-gray-100 mb-8">Overview</p>
                <div id="modalContent">
                <div class="grid grid-cols-2 gap-2">
                    <div class="flex flex-col gap-4">

                 
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
</x-app-layout>
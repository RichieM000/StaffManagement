<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot> --}}

    <!-- Main content with sidebar -->
    <div class="flex">
        <x-sidebar /> <!-- Include the sidebar component -->

        <div class="w-full overflow-x-auto flex-1 p-4">
            <div class="w-full mx-auto sm:px-6 lg:px-8">
                <div class="container mx-auto py-6">
                    <h2 class="font-bold text-2xl mb-8 text-center text-gray-800 leading-tight">
                        {{ __('Admin Dashboard') }}
                    </h2>
                    <div class="flex justify-between items-center">
                        <h1 class="text-2xl font-semibold mb-4">Staff Evaluation</h1>
                        <a href="{{ route('admin-addevaluation') }}" class="rounded bg-green-500 p-1.5 text-white hover:bg-green-700"><i class="ri-add-large-fill"></i> Add Evaluation</a>
                    </div>
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
                    <div class="flex justify-between mt-4">
                   

                    {{-- <form action="{{ route('admin-leave') }}" method="GET" class="flex items-center">
                        <label for="order_by" class="mr-2">Sort by:</label>
                        <select name="order_by" id="order_by" onchange="this.form.submit()" class="mt-1 p-2 border overflow-y-auto border-gray-300 rounded-md w-16 focus:outline-none focus:ring focus:ring-blue-300">
                            <option value="default" {{ $orderBy == 'default' ? 'selected' : '' }}>---</option>
                            <option value="asc" {{ $orderBy == 'asc' ? 'selected' : '' }}>A-Z</option>
                            <option value="desc" {{ $orderBy == 'desc' ? 'selected' : '' }}>Z-A</option>
                        </select>
                    </form> --}}
                    
                </div>
                    
                    {{-- <script>
                        function sortTask() {
                            const orderBy = document.getElementById('order_by').value;
                            const sortForm = document.getElementById('sortForm');
                            sortForm.action = "{{ route('admin.task') }}?order_by=" + orderBy;
                            sortForm.submit();
                        }
                    </script>
 --}}

 <div class="bg-white transition duration-300 ease-in-out shadow-md mt-4 rounded-lg max-w-full overflow-x-auto ">
    <div class="w-full p-4">
        <table class="responsive border-x-2" id="Table">
            <!-- Table headers -->
            <thead class="bg-gray-800 text-white">
                <tr class="uppercase text-sm font-medium leading-normal">
                    <!-- Existing headers -->
                    <th style="text-align: left"><input type="checkbox" id="checkboxmain"></th>
                    <th style="text-align: left" class="px-4 py-2 whitespace-nowrap">#</th>
                    <th class="px-4 py-2 whitespace-nowrap">Staff</th>
                    <th class="px-4 py-2 whitespace-nowrap">Job Position</th>
                    <th class="px-4 py-2 whitespace-nowrap">Task Assigned</th>
                    {{-- <th class="px-4 py-2 whitespace-nowrap">Attendance Tracking</th> --}}
                    <th class="px-4 py-2 whitespace-nowrap">Feedback</th>
                    <th class="px-4 py-2 whitespace-nowrap">Date</th>
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
                    <td><input type="checkbox" class="checkbox" data-id="{{$evaluation->id}}"></td>
                    <td style="text-align: left" class="px-4 py-2 whitespace-nowrap">{{$counter++}}.</td>
                <td class="px-4 py-2 whitespace-nowrap">{{ $evaluation->user->fname }} {{ $evaluation->user->lname }}</td>
                <td class="px-4 py-2 whitespace-nowrap">{{ $evaluation->user->jobrole }}</td>
                <td class="px-4 py-2 whitespace-nowrap">{{ $evaluation->task->title }}</td>
                {{-- <td class="px-4 py-2 whitespace-nowrap"><a class="bg-button p-1 rounded text-white" href="">Check Attendance</a></td> --}}
                <td class="px-4 py-2 whitespace-nowrap">{{ $evaluation->feedback }}</td>
                <td class="px-4 py-2 whitespace-nowrap">{{ \Carbon\Carbon::parse($evaluation->created_at)->format('F j, Y') }}</td>
                <td style="text-align: left" class="px-4 py-2 whitespace-nowrap">{{ $evaluation->total_average }}%</td>

                <td class="py-3 px-6 whitespace-nowrap flex justify-center gap-2">
                    <div>
                        <a class="text-xl text-green-500 hover:text-green-700 open-modal-btn" data-id="{{ $evaluation->id }}"><i class="ri-eye-fill"></i></a>
                    </div>
                    <div>
                        <a class="text-xl text-button hover:text-hover" href="/admin/edit/{{$evaluation->id}}"><i class="ri-edit-fill"></i></a>
                    </div>
                    <form action="/admin/destroy{{$evaluation->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this task assignment?')" class="text-red-500 text-xl hover:text-red-700"><i class="ri-delete-bin-fill"></i></button>
                    </form>
                    
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
                        <h3 class="font-semibold underline underline-offset-4 decoration-green-500 decoration-2">Job Position</h3>
                        <p id="staffJobrole"></p>
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
            url: '/admin/evaluation/' + evaluationId,
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                modalContent.find('#staffName').text(data.staffName);
                modalContent.find('#staffJobrole').text(data.staffJobrole);
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

        {{-- <script>
            document.addEventListener('DOMContentLoaded', function () {
                const modal = document.getElementById('myModal');
                const closeModal = document.getElementById('closeModal');
                const modalContent = document.getElementById('modalContent');
        
                // Function to open the modal with dynamic content
                function openModal(evaluationId) {
                    modalContent.textContent = `Evaluation ID: ${evaluationId}`; // Update modal content with evaluation ID
                    modal.classList.remove('hidden');
                }
        
                // Function to close the modal
                function closeModalFunc() {
                    modal.classList.add('hidden');
                }
        
                // Event listener for the close button
                closeModal.addEventListener('click', closeModalFunc);
        
                // Event listener for clicks outside the modal content
                window.addEventListener('click', function (event) {
                    if (event.target === modal) {
                        closeModalFunc();
                    }
                });
        
                // Make openModal function globally accessible
                window.openModal = openModal;
            });
        </script> --}}
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
                            <script src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>
                            <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
                            <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
                            <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
                            <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
                            <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
                                <script type="text/javascript">
                                    $(document).ready(function(){

                                        $('#checkboxmain').on('click', function(e){
                                            if ($(this).is(':checked', true)){
                                                $(".checkbox").prop('checked', true);
                                            }else{
                                                $(".checkbox").prop('checked', false)
                                            }
                                        });

                                        $('.checkbox').on('click', function(){
                                            if ($('.checkbox:checked').length == $('.checkbox').length){
                                                $('#checkboxmain').prop('checked', true);
                                            }else{
                                                $('#checkboxmain').prop('checked', false);
                                            }
                                        });

                                        // $('.deleteselect').on('click', function(){
                                        //     var tableIdArr = [];
                                        //     $(".checkbox:checked").each(function(){
                                        //         tableIdArr.push($(this).attr('data-id'))
                                        //     });
                                        //     if(tableIdArr.length <= 0){
                                        //         alert("Choose atleast one item to delete");
                                                
                                        //     }
                                        // });

                                    });
                                </script>
                                <script>
                                    new DataTable('#Table', {
                                        responsive: true,

                                        columnDefs: [
                                                { targets: 0, orderable: false } // targets: 0 means the first column
                                            ],
                                       
                                        layout: {
                                            topStart: {
                                                buttons: ['copy', 'csv', 'excel', 'print',  {
                                                        text: 'Selected Delete',
                                                        className: 'deleteselect',
                                                      action: function (e, dt, node, config) {
                                                            var tableIdArr = [];
                                                            $(".checkbox:checked").each(function(){
                                                                tableIdArr.push($(this).attr('data-id'));
                                                            });
                                                            if(tableIdArr.length <= 0){
                                                             alert("Choose at least one item to delete");
                                                                
                                                            } else{
                                                                if(confirm("Are you sure you want to delete?")){
                                                                  var rowId = tableIdArr.join(",");
                                                                    $.ajax({
                                                                        url: "{{url('delete-multiple-rows')}}",
                                                                        type: 'DELETE',
                                                                        headers: {
                                                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                                        },
                                                                    data: 'ids=' + rowId,
                                                                        success: function(data){
                                                                            if(data['status'] == true){
                                                                                $(".checkbox:checked").each(function(){
                                                                                    $(this).parents("tr").remove();
                                                                             });
                                                                                alert(data['delete']);
                                                                            }else{
                                                                                alert('error occured');
                                                                         }
                                                                        },
                                                                        error: function(data){
                                                                            alert(data.responseText);
                                                                        }
                                                                    });
                                                                }
                                                            }
                                                        }
                                                    }]
                                            }
                                        }
                                    });

                                    
                                   
                                </script>
                            </div>
 </div>
                    <!-- Pagination links -->
                    {{-- <div class="mt-4">
                        {{ $leaveRequests->appends(['order_by' => $orderBy])->links() }}

                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
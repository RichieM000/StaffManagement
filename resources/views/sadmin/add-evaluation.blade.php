<x-app-layout>
    
    <!-- Main content with sidebar -->
    <div class="flex">
        <x-systemsidebar /> <!-- Include the sidebar component -->

        <div class="container md:w-3/4 lg:w-9/12 mx-12 py-6">
            <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold mb-4">New Evaluation</h1>
            <a href="{{route('sadmin_evaluation')}}" class="bg-button px-6 py-1 text-white rounded-md hover:bg-hover">Back</a>
        </div>

        <div class="container mx-auto mt-8">
            <form method="POST" action="{{route('sadmin_storeevaluation')}}" class="max-w-lg mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
            
                <div class="mb-4">
                    <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">User</label>
                    <select name="user_id" id="user_id" class="form-select block w-full border border-gray-300 rounded-md py-2 px-3 leading-tight focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                        @foreach($staff as $user)
                            <option value="{{ $user->id }}">{{ $user->fname }}</option>
                        @endforeach
                    </select>
                </div>
            
                <div class="mb-4">
                    <label for="task_id" class="block text-gray-700 text-sm font-bold mb-2">Task</label>
                    <select name="task_id" id="task_id" class="form-control block w-full border border-gray-300 rounded-md py-2 px-3 leading-tight focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                     
                    </select>
                </div>
            
                <div class="grid grid-cols-2 gap-2">
                <div class="mb-4">
                    <label for="efficiency" class="block text-gray-700 text-sm font-bold mb-2">Efficiency</label>
                    <select name="efficiency" id="efficiency" class="form-select block w-full border border-gray-300 rounded-md py-2 px-3 leading-tight focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="mb-4">
                    <label for="quality" class="block text-gray-700 text-sm font-bold mb-2">Quality</label>
                    <select name="quality" id="quality" class="form-select block w-full border border-gray-300 rounded-md py-2 px-3 leading-tight focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="mb-4">
                    <label for="timeliness" class="block text-gray-700 text-sm font-bold mb-2">Timeliness</label>
                    <select name="timeliness" id="timeliness" class="form-select block w-full border border-gray-300 rounded-md py-2 px-3 leading-tight focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="mb-4">
                    <label for="accuracy" class="block text-gray-700 text-sm font-bold mb-2">Accuracy</label>
                    <select name="accuracy" id="accuracy" class="form-select block w-full border border-gray-300 rounded-md py-2 px-3 leading-tight focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="mb-4">
                    <label for="tardiness" class="block text-gray-700 text-sm font-bold mb-2">Tardiness</label>
                    <select name="tardiness" id="tardiness" class="form-select block w-full border border-gray-300 rounded-md py-2 px-3 leading-tight focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>
                <!-- Other rating fields (quality, timeliness, accuracy, tardiness) -->
            
                <div class="mb-4">
                    <label for="feedback" class="block text-gray-700 text-sm font-bold mb-2">Feedback</label>
                    <textarea name="feedback" id="feedback" class="form-textarea block w-full border border-gray-300 rounded-md py-2 px-3 leading-tight focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500" rows="3"></textarea>
                </div>
            
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Submit</button>
            </form>
            
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const userSelect = document.getElementById('user_id');
                    const taskSelect = document.getElementById('task_id');
            
                    userSelect.addEventListener('change', function () {
                        const userId = userSelect.value;
                        // Clear existing options
                        taskSelect.innerHTML = '';
            
                        // Fetch tasks assigned to the selected user using AJAX
                        fetch(`/systemadmin/get-tasks/${userId}`)
                            .then(response => response.json())
                            .then(data => {
                                data.forEach(task => {
                                    const option = document.createElement('option');
                                    option.value = task.id;
                                    option.textContent = task.title;
                                    taskSelect.appendChild(option);
                                });
                            })
                            .catch(error => {
                                console.error('Error fetching tasks:', error);
                            });
                    });
                });
            </script>
        </div>
        
    </div>
</x-app-layout>
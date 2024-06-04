<x-app-layout>
    
    <!-- Main content with sidebar -->
    <div class="flex">
        <x-sidebar /> <!-- Include the sidebar component -->

        <div class="container md:w-3/4 lg:w-9/12 mx-12 py-6">
            <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold mb-4">Edit Evaluation</h1>
            <a href="{{route('admin-evaluation')}}" class="bg-button px-6 py-1 text-white rounded-md hover:bg-hover">Back</a>
        </div>

        <div class="container mx-auto mt-8">
            <form method="POST" action="/admin/update{{$evaluation->id}}" class="max-w-lg mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">User</label>
                    <select name="user_id" id="user_id" class="form-select block w-full border border-gray-300 rounded-md py-2 px-3 leading-tight focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                        @foreach($staff as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $evaluation->user_id ?? '') == $user->id ? 'selected' : '' }}>{{ $user->fname }}</option>
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
                            <option value="{{ $i }}" {{ old('efficiency', $evaluation->efficiency) == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="mb-4">
                    <label for="quality" class="block text-gray-700 text-sm font-bold mb-2">Quality</label>
                    <select name="quality" id="quality" class="form-select block w-full border border-gray-300 rounded-md py-2 px-3 leading-tight focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ old('quality', $evaluation->quality) == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="mb-4">
                    <label for="timeliness" class="block text-gray-700 text-sm font-bold mb-2">Timeliness</label>
                    <select name="timeliness" id="timeliness" class="form-select block w-full border border-gray-300 rounded-md py-2 px-3 leading-tight focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ old('timeliness', $evaluation->timeliness) == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="mb-4">
                    <label for="accuracy" class="block text-gray-700 text-sm font-bold mb-2">Accuracy</label>
                    <select name="accuracy" id="accuracy" class="form-select block w-full border border-gray-300 rounded-md py-2 px-3 leading-tight focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ old('accuracy', $evaluation->accuracy) == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="mb-4">
                    <label for="tardiness" class="block text-gray-700 text-sm font-bold mb-2">Tardiness</label>
                    <select name="tardiness" id="tardiness" class="form-select block w-full border border-gray-300 rounded-md py-2 px-3 leading-tight focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ old('tardiness', $evaluation->tardiness) == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>


                <div class="mb-4">
                   <div class="ml-6 text-sm">
                    
                   <ul class="">
                    <li>5 - Outstanding</li>
                    <li>4 - Exceeds Expectaion</li>
                    <li>3 - Meets Expectaion</li>
                    <li>2 - Needs Improvement</li>
                    <li>1 - Unsatisfactory</li>
                   </ul>
                   </div>
                </div>
            </div>
                <!-- Other rating fields (quality, timeliness, accuracy, tardiness) -->
            
                <div class="mb-4">
                    <label for="feedback" class="block text-gray-700 text-sm font-bold mb-2">Feedback</label>
                    <textarea name="feedback" id="feedback" class="form-textarea block w-full border border-gray-300 rounded-md py-2 px-3 leading-tight focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500" rows="3">{{ old('description', $evaluation->feedback) }}</textarea>
                </div>
            
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
            </form>
            
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const userSelect = document.getElementById('user_id');
                    const taskSelect = document.getElementById('task_id');
                    const oldTaskId = "{{ old('task_id') }}"; // Blade directive to get the old task_id value
                    
                    userSelect.addEventListener('change', function () {
                        const userId = userSelect.value;
                        // Clear existing options
                        taskSelect.innerHTML = '';
                        
                        // Fetch tasks assigned to the selected user using AJAX
                        fetch(`/get-tasks/${userId}`)
                            .then(response => response.json())
                            .then(data => {
                                data.forEach(task => {
                                    const option = document.createElement('option');
                                    option.value = task.id;
                                    option.textContent = task.title;
            
                                    // Check if this option should be selected
                                    if (task.id == oldTaskId) {
                                        option.selected = true;
                                    }
            
                                    taskSelect.appendChild(option);
                                });
                            })
                            .catch(error => {
                                console.error('Error fetching tasks:', error);
                            });
                    });
            
                    // Trigger change event if there's an old value to pre-populate tasks
                    if (userSelect.value) {
                        userSelect.dispatchEvent(new Event('change'));
                    }
                });
            </script>
        </div>
        
    </div>
</x-app-layout>
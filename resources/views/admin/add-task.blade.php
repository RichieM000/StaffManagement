<div id="assignTaskModal" class=" fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="{{ route('assign-task') }}" method="POST">
                @csrf
                <!-- Staff ID -->
                <input type="hidden" name="staff_id" id="staffId">
                <!-- Task Title -->
                <div class="bg-gray-50 px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium text-gray-900">Assign Task</h3>
                </div>
                <div class="bg-white px-4 pb-4 sm:px-6">
                    <label for="task_title" class="block text-sm font-medium text-gray-700">Task Title</label>
                    <input type="text" name="title" id="task_title" class="mt-1 mb-4 p-2 border border-gray-300 rounded-md w-full">
                    <!-- Additional Task Fields (e.g., description, deadline) -->
                    <!-- Task Description -->
                    <label for="task_description" class="block text-sm font-medium text-gray-700">Task Description</label>
                    <textarea name="description" id="task_description" rows="3" class="mt-1 mb-4 p-2 border border-gray-300 rounded-md w-full"></textarea>
                    
                    
                    
                    <label for="jobrole_selection" class="block text-sm font-medium text-gray-700">Include Other Departments:</label>
                    <div class="space-y-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="job_role[]" value="kapitan" class="form-checkbox text-indigo-600 h-5 w-5">
                            <span class="ml-2 text-gray-700">Kapitan</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="job_role[]" value="vice kap" class="form-checkbox text-indigo-600 h-5 w-5">
                            <span class="ml-2 text-gray-700">Vice Kap</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="job_role[]" value="secretary" class="form-checkbox text-indigo-600 h-5 w-5">
                            <span class="ml-2 text-gray-700">Secretary</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="job_role[]" value="treasurer" class="form-checkbox text-indigo-600 h-5 w-5">
                            <span class="ml-2 text-gray-700">Treasurer</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="job_role[]" value="chairman" class="form-checkbox text-indigo-600 h-5 w-5">
                            <span class="ml-2 text-gray-700">Chairman</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="job_role[]" value="kagawad" class="form-checkbox text-indigo-600 h-5 w-5">
                            <span class="ml-2 text-gray-700">Kagawad</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="job_role[]" value="tanod" class="form-checkbox text-indigo-600 h-5 w-5">
                            <span class="ml-2 text-gray-700">Tanod</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="job_role[]" value="sk" class="form-checkbox text-indigo-600 h-5 w-5">
                            <span class="ml-2 text-gray-700">SK</span>
                        </label>
                        <!-- Add more job roles as needed -->
                    </div>
                    
                    
                    <!-- Task Deadline -->
                    <label for="task_deadline" class="block text-sm font-medium text-gray-700">Task Deadline</label>
                    <input type="date" name="deadline" id="task_deadline" class="mt-1 mb-4 p-2 border border-gray-300 rounded-md w-full">
                </div>
                <!-- Task Submission Button -->
                <div class="bg-gray-50 px-4 py-4 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">Assign Task</button>
                    <button type="button" onclick="closeAssignTaskModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
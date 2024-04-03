<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <!-- Main content with sidebar -->
    <div class="flex">
        <x-sidebar /> <!-- Include the sidebar component -->

        <div class="container md:w-3/4 lg:w-9/12 mx-12 py-6">
            <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold mb-4">Add New Task</h1>
            <a href="{{route('admin.task')}}" class="bg-button px-6 py-1 text-white rounded-md hover:bg-hover">Back</a>
        </div>

        <div class="container mx-auto mt-8">
            <form action="{{route('tasks-store')}}" method="POST" class="max-w-md mx-auto">
                @csrf
                <!-- Task Title -->
                <div class="mb-4">
                    <label for="title" class="block font-medium text-sm text-gray-700">Task Title:</label>
                    <input type="text" name="title" id="title" class="form-input mt-1 block w-full" required>
                </div>
        
                <!-- Task Description -->
                <div class="mb-4">
                    <label for="description" class="block font-medium text-sm text-gray-700">Task Description:</label>
                    <textarea name="description" id="description" rows="3" class="form-textarea mt-1 block w-full" required></textarea>
                </div>
        
                <!-- Job Role Selection -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Select Job Roles:</label>
                    <div class="mt-2 space-y-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="job_roles[]" value="Chairman" class="form-checkbox ml-2">
                            <span class="ml-1">Chairman</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="job_roles[]" value="Secretary" class="form-checkbox ml-2">
                            <span class="ml-1">Secretary</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="job_roles[]" value="Treasurer" class="form-checkbox ml-2">
                            <span class="ml-1">Treasurer</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="job_roles[]" value="Kagawad" class="form-checkbox ml-2">
                            <span class="ml-1">Kagawad</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="job_roles[]" value="Tanod" class="form-checkbox ml-2">
                            <span class="ml-1">Tanod</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="job_roles[]" value="SK Chairman" class="form-checkbox ml-2">
                            <span class="ml-1">SK Chairman</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="job_roles[]" value="SK" class="form-checkbox ml-2">
                            <span class="ml-1">SK</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="job_roles[]" value="BHW" class="form-checkbox ml-2">
                            <span class="ml-1">Barangay Health Workers</span>
                        </label>
                        <!-- Add more job roles as needed -->
                    </div>
                </div>
        
                <!-- Task Deadline -->
                <div class="mb-6">
                    <label for="deadline" class="block font-medium text-sm text-gray-700">Task Deadline:</label>
                    <input type="date" name="deadline" id="deadline" class="form-input mt-1 block w-full" required>
                </div>
        
                <!-- Task Submission Button -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Task</button>
                </div>
            </form>
        </div>
        
    </div>
</x-app-layout>
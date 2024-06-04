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
            <h1 class="text-2xl font-semibold mb-4">Edit Task</h1>
            <a href="{{route('admin.task')}}" class="bg-button px-6 py-1 text-white rounded-md hover:bg-hover">Back</a>
        </div>

        <div class="container mx-auto mt-8">
            <form action="/update-tasks/{{$task->id}}" method="POST" class="max-w-md mx-auto">
                @csrf
                @method('PUT')
                <!-- Task Title -->
                <div class="mb-4 col-span-2">
                    <x-input-label for="jobrole" :value="__('Job Position')" />
                    <select name="jobrole" id="jobrole" value="{{ old('jobrole', $task->jobrole) }}" class="mt-1 p-2 borderoverflow-y-auto border-gray-300 rounded-md w-full">
                        <option>--Select Position--</option>
                        <option value="Chairman" {{$task->jobrole == 'Chairman' ? 'selected' : ''}}>Chairman</option>
                            <option value="Secretary" {{$task->jobrole == 'Secretary' ? 'selected' : ''}}>Secretary</option>
                            <option value="Treasurer" {{$task->jobrole == 'Treasurer' ? 'selected' : ''}}>Treasurer</option>
                            <option value="Kagawad" {{$task->jobrole == 'Kagawad' ? 'selected' : ''}}>Kagawad</option>
                            <option value="Tanod" {{$task->jobrole == 'Tanod' ? 'selected' : ''}}>Tanod</option>
                            <option value="SKchairman" {{$task->jobrole == 'SKchairman' ? 'selected' : ''}}>SK Chairman</option>
                            <option value="SK" {{$task->jobrole == 'SK' ? 'selected' : ''}}>SK</option>
                            <option value="Clerk" {{$task->jobrole == 'Clerk' ? 'selected' : ''}}>Clerk</option>
                            <option value="BHW" {{$task->jobrole == 'BHW' ? 'selected' : ''}}>Barangay Health Workers</option>
                    </select>
                    <x-input-error :messages="$errors->get('jobrole')" class="mt-2" />
                </div>


                    
                 <div class="mb-4">
                    <label for="staffs" class="block text-sm font-medium text-gray-700 mb-3">Assign To:</label>
                    <select name="staffs[]" id="staffs" class="form-select block w-full mt-1 p-2 border border-gray-300 rounded-md">
                        <option value="">--Select User--</option>
                        @foreach($staffWithRoles as $user)
                            <option class="capitalize" value="{{ $user->id }}" data-jobrole="{{ $user->jobrole }}">{{ $user->fname }} {{ $user->lname }}</option>
                            <option value="{{ $user->id }}" {{ old('user_id', $task->assigned_to ?? '') == $user->id ? 'selected' : '' }}>{{ $user->fname }} {{ $user->lname }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('staffs')" class="mt-2" />
                </div>


              

                <div class="mb-4">
                    <label for="title" class="block font-medium text-sm text-gray-700">Task Title:</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" class="mt-1 p-2 borderoverflow-y-auto border-gray-300 rounded-md w-full" required>
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>
        
                <!-- Task Description -->
                <div class="mb-4">
                    <label for="description" class="block font-medium text-sm text-gray-700">Task Description:</label>
                    <textarea name="description" id="description" rows="3" class="mt-1 p-2 borderoverflow-y-auto border-gray-300 rounded-md w-full" required>{{ old('description', $task->description) }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                 <!-- Task Deadline -->
                 <div class="mb-6">
                    <label for="deadline" class="block font-medium text-sm text-gray-700">Task Deadline:</label>
                    <input type="date" name="deadline" id="deadline" value="{{ old('deadline', $task->deadline) }}"  class="mt-1 p-2 borderoverflow-y-auto border-gray-300 rounded-md w-full" required>
                    <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
                </div>

                <!-- Task Submission Button -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Task</button>
                </div>
                
            </form>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
   

    <!-- Main content with sidebar -->
    <div class="flex">
        <x-systemsidebar /> <!-- Include the sidebar component -->

        <div class="container md:w-3/4 lg:w-9/12 mx-12 py-6">
            <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold mb-4">Add New Task</h1>
            <a href="{{route('sadmin_showtasks')}}" class="bg-button px-6 py-1 text-white rounded-md hover:bg-hover">Back</a>
        </div>

        <div class="container mx-auto mt-8">
            <form action="{{ route('sadmin_storetasks') }}" method="POST" class="max-w-md mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
            
                <!-- Task Title -->
                <div class="mb-4">
                    <label for="jobrole" class="block text-sm font-medium text-gray-700">Job Position:</label>
                    <select name="jobrole" id="jobrole" class="form-select block w-full mt-1 p-2 border border-gray-300 rounded-md">
                        <option value="">--Select Position--</option>
                        <option value="Chairman">Chairman</option>
                        <option value="Secretary">Secretary</option>
                        <option value="Treasurer">Treasurer</option>
                        <option value="Kagawad">Kagawad</option>
                        <option value="Tanod">Tanod</option>
                        <option value="SKchairman">SK Chairman</option>
                        <option value="SK">SK</option>
                        <option value="Clerk">Clerk</option>
                        <option value="BHW">Barangay Health Workers</option>
                    </select>
                    <x-input-error :messages="$errors->get('jobrole')" class="mt-2" />
                </div>
            
                <!-- Assign To -->
                <div class="mb-4">
                    <label for="staffs" class="block text-sm font-medium text-gray-700 mb-3">Assign To:</label>
                    <select name="staffs[]" id="staffs" class="form-select block w-full mt-1 p-2 border border-gray-300 rounded-md">
                        <option value="">--Select User--</option>
                        @foreach($staffWithRoles as $user)
                            <option class="capitalize" value="{{ $user->id }}" data-jobrole="{{ $user->jobrole }}">{{ $user->fname }} {{ $user->lname }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('staffs')" class="mt-2" />
                </div>
               
                
                
                
                <!-- Task Title -->
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Task Title:</label>
                    <input type="text" name="title" id="title" class="form-input block w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                </div>
            
                <!-- Task Description -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Task Description:</label>
                    <textarea name="description" id="description" rows="3" class="form-textarea block w-full mt-1 p-2 border border-gray-300 rounded-md" required></textarea>
                </div>
            
                <!-- Task Deadline -->
                <div class="mb-6">
                    <label for="deadline" class="block text-sm font-medium text-gray-700">Task Deadline:</label>
                    <input type="date" name="deadline" id="deadline" class="form-input block w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                </div>
            
                <!-- Task Submission Button -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Task</button>
                </div>
            </form>
            
            
            <script>
                document.addEventListener('DOMContentLoaded', function () {
        const jobroleSelect = document.getElementById('jobrole');
        const staffSelect = document.getElementById('staffs');
        
        jobroleSelect.addEventListener('change', function () {
            const selectedJobrole = jobroleSelect.value;
            const staffOptions = staffSelect.querySelectorAll('option');

            staffOptions.forEach(option => {
                const jobrole = option.getAttribute('data-jobrole');
                if (jobrole === selectedJobrole || selectedJobrole === '') {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });

            staffSelect.value = ''; // Reset the selected user
        });
    });
            </script>
        </div>
       
    </div>
</x-app-layout>
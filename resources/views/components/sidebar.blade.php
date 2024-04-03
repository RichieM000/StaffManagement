<!-- resources/views/components/sidebar.blade.php -->

<aside class="bg-gray-800 mr-8 text-white h-screen min-w-72 flex flex-col">
    
    <div class="relative m-4">
        <form action="#" method="get">
            <input type="text" placeholder="Search..." name="search" class="bg-white h-10 px-5 pr-10 border rounded-full text-sm focus:outline-none min-w-60">
            <!-- Adjust the minimum width value as needed for different screen sizes -->
            <button type="submit" class="absolute right-5 top-0 mt-2 mr-4">
                <span class="text-gray-600 h-4 w-4 fill-current"><i class="ri-search-line"></i></span>
            </button>
        </form>
    </div>
    <div class="p-4">
        <h1 class="text-xl text-button text-justify font-semibold">{{ __('Staff Management Solutions') }}</h1>
    </div>
    <nav class="flex-1">
        <ul class="space-y-4 text-lg font-ecom">
            <li>
                <a href="{{ route('dashboard') }}"  class=" transition duration-300 ease-in-out block py-2 px-4 hover:bg-gray-700"><i class="ri-dashboard-fill"></i> Dashboard</a>
            </li>
            <li>
                <a href="{{ route('user') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700"><i class="ri-user-fill"></i> User</a>
            </li>
            <li>
                <a href="{{ route('admin.staff') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700"><i class="ri-user-2-fill"></i> Staff Management</a>
            </li>
            <li>
                <a href="{{ route('admin.teams') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700"><i class="ri-team-fill"></i> Departments & Teams</a>
            </li>
            <li>
                <a href="{{ route('admin.task') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700"><i class="ri-task-fill"></i> Task Management</a>
            </li>
            <li>
                <a href="#" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700"><i class="ri-calendar-schedule-fill"></i> Attendance & Time Tracking</a>
            </li>
            <li>
                <a href="#" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700"><i class="ri-feedback-fill"></i> Performance Evaluation</a>
            </li>
            <li>
                <a href="#" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700"><i class="ri-donut-chart-fill"></i> Reports & Analytics</a>
            </li>
            <li>
                <a href="#" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700"><i class="ri-question-fill"></i> Help & Support</a>
            </li>
            <!-- Add more sidebar menu items as needed -->
        </ul>
    </nav>
</aside>

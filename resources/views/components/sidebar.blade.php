<!-- resources/views/components/sidebar.blade.php -->

<aside class="bg-gray-800 mr-8 text-white h-screen min-w-72 flex flex-col">
    
    {{-- Logo/Header --}}
    <div class="p-4">
        <h1 class="text-2xl bg-white p-4 rounded-md text-button font-bold">{{ __('Staff Management Solutions') }}</h1>
    </div>
    <nav class="flex-1">
        <ul class="space-y-4 text-lg font-ecom">
            <li>
                <a href="{{ route('dashboard') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'dashboard') bg-gray-700 @endif">
                    <i class="ri-dashboard-fill"></i> Dashboard
                </a>
                <li>
                    <a href="{{ route('user') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'user') bg-gray-700 @endif">
                        <i class="ri-user-fill"></i> User
                    </a>
                </li>
            <li>
                <a href="{{ route('admin.staff') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'admin.staff') bg-gray-700 @endif" ><i class="ri-user-2-fill"></i> Staff Management</a>
            </li>
            {{-- <li>
                <a href="{{ route('admin.teams') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'admin.teams') bg-gray-700 @endif"><i class="ri-team-fill"></i> Departments & Teams</a>
            </li> --}}
            <li>
                <a href="{{ route('admin.task') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'admin.task') bg-gray-700 @endif"><i class="ri-task-fill "></i> Task Management</a>
            </li>
            <li>
                <a href="#" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 "><i class="ri-calendar-schedule-fill"></i> Attendance & Time Tracking</a>
            </li>
            <li>
                <a href="{{ route('admin-leave') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'admin-leave') bg-gray-700 @endif"><i class="ri-calendar-close-fill"></i> Leave Management</a>
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

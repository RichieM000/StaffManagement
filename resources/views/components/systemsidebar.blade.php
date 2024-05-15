<!-- resources/views/components/sidebar.blade.php -->

<aside class="bg-gray-800 mr-8 text-white max-w-sm flex flex-col flex-grow min-h-screen">
    
    {{-- Logo/Header --}}
    <div class="p-4">
        <h1 class="text-2xl bg-white p-4 rounded-md text-button font-bold">{{ __('Staff Management Solutions') }}</h1>
    </div>
    <nav class="flex-1">
        <ul class="space-y-4 text-lg font-ecom">
            <li>
                <a href="{{route('sadmin_dashboard')}}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'sadmin_dashboard') bg-gray-700 @endif">
                    <i class="ri-dashboard-fill"></i> Dashboard
                </a>
                {{-- <li>
                    <a href="{{ route('user') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'user') bg-gray-700 @endif">
                        <i class="ri-user-fill"></i> User
                    </a>
                </li> --}}
                <li class="relative" id="dropdownButton">
                    <div onclick="toggleDropdown()" class="flex justify-between py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 
                    @if(request()->route()->getName() == 'sadmin_showusers')
                    @elseif(request()->route()->getName() == 'admin.register') bg-gray-700 @endif">
                        <div class="flex gap-1">
                        <i class="ri-team-fill"></i>
                        <p>Manage Staff's</p>
                    </div>
                        <i class="ri-arrow-down-s-fill"></i>
                        
                    </div>
    
                <div class="hidden" id="dropdown">
                    <div class=" py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700">
                        <a href="{{ route('sadmin_showusers') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'sadmin_showusers') bg-gray-700 @endif" ><i class="ri-user-2-fill"></i> Staff</a>
    
                    </div>

                    <div class=" py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700">
                        <a href="{{ route('sadmin_createadmin') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'sadmin_createadmin') bg-gray-700 @endif" ><i class="ri-admin-fill"></i> Create New Admin</a>
     
                    </div>
    
                    <div class=" py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700">
                        <a href="{{ route('sadmin.register') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'sadmin.register') bg-gray-700 @endif" ><i class="ri-user-shared-2-fill"></i> Register Staff</a>
     
                    </div>
                </div>
    
                </li>
                <script>
                    function toggleDropdown(){
                        let dropdown = document.querySelector("#dropdownButton #dropdown");
                        dropdown.classList.toggle('hidden');
                    }
                </script>
            {{-- <li>
                <a href="{{route('sadmin_showstaffs')}}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'sadmin_showstaffs') bg-gray-700 @endif" ><i class="ri-user-2-fill"></i> Staff</a>
            </li> --}}
            {{-- <li>
                <a href="{{ route('admin.teams') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'admin.teams') bg-gray-700 @endif"><i class="ri-team-fill"></i> Departments & Teams</a>
            </li> --}}
            <li>
                <a href="{{route('sadmin_showtasks')}}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'sadmin_showtasks') bg-gray-700 @endif"><i class="ri-task-fill "></i> Task Management</a>
            </li>
            <li>
                <a href="{{route('sadmin_showattendance')}}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'sadmin_showattendance') bg-gray-700 @endif"><i class="ri-calendar-schedule-fill"></i> Attendance & Time Tracking</a>
            </li>
            <li>
                <a href="{{route('sadmin_showattendancesheet')}}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'sadmin_showattendancesheet') bg-gray-700 @endif "><i class="ri-time-fill"></i> Time In/Time Out Monitoring</a>
            </li>
            <li>
                <a href="{{route('sadmin_showleave')}}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'sadmin_showleave') bg-gray-700 @endif"><i class="ri-calendar-close-fill"></i> Leave Management</a>
            </li>
            <li>
                <a href="{{route('sadmin_evaluation')}}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'sadmin_evaluation') bg-gray-700 @endif"><i class="ri-feedback-fill"></i> Performance Evaluation</a>
            </li>

            <li>
                <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                    @csrf
            
                    <a href="#" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                        <i class="ri-logout-box-r-fill"></i> Logout
                    </a>
                </form>
            </li>
           
            {{-- <li>
                <a href="#" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700"><i class="ri-donut-chart-fill"></i> Reports & Analytics</a>
            </li>
            <li>
                <a href="#" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700"><i class="ri-question-fill"></i> Help & Support</a>
            </li> --}}
            <!-- Add more sidebar menu items as needed -->
        </ul>
    </nav>
</aside>

<!-- resources/views/components/sidebar.blade.php -->
<div class="md:hidden bg-gray-800 flex flex-col h-screen p-4 transition duration-300 ease-in-out">
    <button id="sidebarToggle" class="text-white p-2 rounded"><i class="ri-align-justify"></i></button>
    <button id="closebarToggle" class="text-white p-2 rounded hidden"><i class="ri-close-large-fill"></i></button>
</div>
<script>
    // const openBtn = document.getElementById('sidebarToggle');
    // const closeBtn = document.getElementById('closebarToggle');
    // const sideBar = document.getElementById('sidebar');
    
    // openBtn.addEventListener('click', function(){
    //     sideBar.classList.toggle('hidden');
        
    // });
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        var sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('hidden');
        var closeBtn = document.getElementById('closebarToggle');
        closeBtn.classList.toggle('hidden');
        var openBtn = document.getElementById('sidebarToggle');
        openBtn.classList.toggle('hidden');
    });

    document.getElementById('closebarToggle').addEventListener('click', function() {
        var sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('hidden');
        var closeBtn = document.getElementById('closebarToggle');
        closeBtn.classList.toggle('hidden');
        var openBtn = document.getElementById('sidebarToggle');
        openBtn.classList.toggle('hidden');
    });
</script>
<aside id="sidebar" class="bg-gray-800 transition duration-300 ease-in-out mr-8 text-white max-w-sm flex flex-col flex-grow z-10 min-h-screen hidden md:block">
    {{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdownToggle = document.getElementById('attendanceDropdown');
        const dropdownMenu = document.getElementById('attendanceDropdownMenu');

        dropdownToggle.addEventListener('click', function () {
            dropdownMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', function (event) {
            if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    });
</script> --}}
    
    {{-- Logo/Header --}}
    <div class="p-4">
        <h1 class="text-2xl bg-white p-4 rounded-md text-green-500 font-bold">Staff Management Solutions</h1>
    </div>
    <nav class="flex-1">
        <ul class="space-y-4 text-lg font-ecom">
            <li>
                <a href="{{ route('dashboard') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'dashboard') bg-gray-700 @endif">
                    <i class="ri-dashboard-fill"></i> Dashboard
                </a>
                {{-- <li>
                    <a href="{{ route('user') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'user') bg-gray-700 @endif">
                        <i class="ri-user-fill"></i> User
                    </a>
                </li> --}}
                <li class="relative" id="dropdownButton">
                <div onclick="toggleDropdown()" class="flex justify-between py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 
                @if(request()->route()->getName() == 'admin.staff')
                @elseif(request()->route()->getName() == 'admin.register') bg-gray-700 @endif">
                    <div class="flex gap-1">
                    <i class="ri-team-fill"></i>
                    <p>Manage Staff's</p>
                </div>
                    <i class="ri-arrow-down-s-fill"></i>
                    
                </div>

            <div class="hidden" id="dropdown">
                <div class=" py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700">
                    <a href="{{ route('admin.staff') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'admin.staff') bg-gray-700 @endif" ><i class="ri-user-2-fill"></i> Staff</a>

                </div>

                <div class=" py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700">
                    <a href="{{ route('admin.register') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'admin.register') bg-gray-700 @endif" ><i class="ri-user-shared-2-fill"></i> Register Staff</a>
 
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
                <a href="{{ route('admin.staff') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'admin.staff') bg-gray-700 @endif" ><i class="ri-user-2-fill"></i> Staff</a>
            </li> --}}
          
            {{-- <li>
                <a href="{{ route('admin.teams') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'admin.teams') bg-gray-700 @endif"><i class="ri-team-fill"></i> Departments & Teams</a>
            </li> --}}
            <li>
                <a href="{{route('admin.logs')}}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'admin.logs') bg-gray-700 @endif "><i class="ri-history-fill"></i> User's Log</a>
            </li>
            <li>
                <a href="{{ route('admin.task') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'admin.task') bg-gray-700 @endif"><i class="ri-task-fill "></i> Task Management</a>
            </li>
            <li>
                <a href="{{ route('admin-attendance') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'admin-attendance') bg-gray-700 @endif "><i class="ri-calendar-schedule-fill"></i> Attendance & Time Tracking</a>
            </li>
            <li>
                <a href="{{ route('admin-attendance2') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'admin-attendance2') bg-gray-700 @endif "><i class="ri-time-fill"></i> AM/PM Time In Monitoring</a>
            </li>


            {{-- <div class="relative">
                <button type="button" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700" id="attendanceDropdown">
                    <div class="flex justify-between w-full">
                    <p><i class="ri-calendar-schedule-fill"></i> Attendance</p> <i class="ri-arrow-down-s-line"></i>
                </div>
                </button>
                <ul class="absolute hidden bg-white rounded shadow-md mt-2" id="attendanceDropdownMenu">
                    <li>
                        <a href="{{ route('admin-attendance') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700">
                            <i class="ri-calendar-schedule-fill"></i> Attendance & Time Tracking
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-attendance2') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700">
                            <i class="ri-calendar-schedule-fill"></i> Attendance Monitoring
                        </a>
                    </li>
                </ul>
            </div> --}}




            <li>
                <a href="{{ route('admin-leave') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'admin-leave') bg-gray-700 @endif"><i class="ri-calendar-close-fill"></i> Leave Management</a>
            </li>
            <li>
                <a href="{{ route('admin-evaluation') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'admin-evaluation') bg-gray-700 @endif"><i class="ri-feedback-fill"></i> Performance Evaluation</a>
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

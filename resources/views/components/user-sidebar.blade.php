<!-- resources/views/components/sidebar.blade.php -->
<div class="md:hidden bg-gray-800 flex flex-col min-h-screen p-4 transition duration-300 ease-in-out">
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
<aside id="sidebar" class="bg-gray-800 transition duration-300 ease-in-out mr-8 text-white max-w-sm flex flex-col flex-grow min-h-screen hidden md:block z-10">
    
    {{-- Logo/Header --}}
    <div class="p-4">
        <h1 class="text-2xl bg-white p-4 rounded-md text-green-500 font-bold">Staff Management Solutions</h1>
    </div>
    <nav class="flex-1">
        <ul class="space-y-4 text-lg font-ecom">
            <li>
                <a href="{{ route('userdashboard') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'userdashboard') bg-gray-700 @endif">
                    <i class="ri-dashboard-fill"></i> Dashboard
                </a>

            <li>
                <a href="{{ route('index.clock')}}"  class=" transition duration-300 ease-in-out block py-2 px-4 hover:bg-gray-700 @if(request()->route()->getName() == 'index.clock') bg-gray-700 @endif "><i class="ri-calendar-schedule-fill"></i> Attendance & Time</a>
            </li>
            <li>
                <a href="{{ route('user.task') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'user.task') bg-gray-700 @endif"><i class="ri-task-fill"></i> Task</a>
            </li>
            <li>
                <a href="{{ route('user.leave') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'user.leave') bg-gray-700 @endif"><i class="ri-calendar-close-fill"></i> File A Leave</a>
            </li>
            <li>
                <a href="{{ route('user.evaluation') }}" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700 @if(request()->route()->getName() == 'user.evaluation') bg-gray-700 @endif"><i class="ri-feedback-fill"></i> Evaluation</a>
            </li>
            {{-- <li>
                <a href="" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700"><i class="ri-team-fill"></i> Departments & Teams</a>
            </li> --}}
           
            <li>
                <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                    @csrf
            
                    <a href="#" class="block py-2 px-4 transition duration-300 ease-in-out hover:bg-gray-700" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                        <i class="ri-logout-box-r-fill"></i> Logout
                    </a>
                </form>
            </li>
        
            <!-- Add more sidebar menu items as needed -->
        </ul>
    </nav>
</aside>
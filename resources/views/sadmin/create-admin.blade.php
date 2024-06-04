<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot> --}}

    <!-- Main content with sidebar -->
    <div class="flex">
        <x-systemsidebar /> <!-- Include the sidebar component -->


        <div class="flex flex-col mx-auto justify-start items-center">

        
            
        <div class="py-6">
            <div class="">
            <h1 class="text-2xl font-semibold mb-4">Create new Admin</h1>
            {{-- <a href="{{route('sadmin_showusers')}}" class="bg-button px-6 py-1 text-white rounded-md hover:bg-hover">Back</a> --}}
        </div>
            <div class="bg-white shadow-md rounded-lg p-6 mx-auto">
                <form action="{{ route('sadmin_storeadmin') }}" method="POST" class="grid grid-cols-2 gap-3">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name" class="mt-1 p-2 capitalize border border-gray-300 rounded-md w-full" required>
                    </div>
                    
                  
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                    </div>

                    
                   

                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Password')" />
            
                        <x-text-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" />
            
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
            
                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            
                        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                        type="password"
                                        name="password_confirmation" required autocomplete="new-password" />
            
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                
                    <input type="hidden" id="usertype" name="usertype" value="admin">
                    
                  
                   
                    <div class="col-span-2 m-auto">
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md">Create Admin</button>
                    </div>
                </form>
            </div>
        </div>
       


        <div>
            @if(session('success'))
            <div id="successMessage" class="bg-green-100 w-full transition duration-300 ease-in-out border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>  
        
            <script>
                // Automatically hide the success message after 5 seconds (5000 milliseconds)
                setTimeout(function() {
                    document.getElementById('successMessage').style.display = 'none';
                }, 3000); // Adjust the timeout value as needed (in milliseconds)
            </script>
            @endif
            <div class="overflow-x-auto w-full p-4">
                <h1 class="font-semibold text-lg pl-6">Admins</h1>
                <table class="responsive border-x-2" id="adminTable">
                    <thead class="bg-gray-800 text-white">
                       
                        <tr class="uppercase text-sm font-medium leading-normal">
                            <!-- Existing headers -->
                            <th style="text-align: left" class="px-4 py-2 whitespace-nowrap">#</th>
                            <th class="px-4 py-2 whitespace-nowrap">Name</th>
                            <th class="px-4 py-2 whitespace-nowrap">Email</th>
                            
                           
                            
                            <th class="py-3 px-6 text-center whitespace-nowrap">Edit</th>
                            <!-- New header for Assign Task button -->
                           
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-semibold">
                       
                        @php $counter = 1 @endphp <!-- Initialize counter -->
                            @foreach ($admins as $admin)
                              
                                <tr class="border-b border-gray-200 transition duration-300 ease-in-out text-center hover:bg-gray-100 ">
                                    <td style="text-align: left" class="px-4 py-2">{{ $counter++ }}.</td>
                                    <td class="px-4 py-2 whitespace-wrap">{{$admin->name}}</td>
                                    <td class="px-4 py-2 whitespace-wrap">{{$admin->email}}</td>
                                   
                                    
                                    <td style="display:flex;align-items: center;border-bottom:0;" class="py-3 px-6 text-center whitespace-nowrap flex justify-center gap-2">
                                        <div>
                                            <button class="text-xl text-button hover:text-hover"  onclick="openAdminModal({{ json_encode($admin) }})"><i class="ri-edit-fill"></i></button>
                                        </div>
                                        <form action="/delete-users/" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure you want to delete this staff member?')" class="text-red-500 text-xl hover:text-red-700"><i class="ri-delete-bin-fill"></i></button>
                                        </form>
                                    </td>
                               
                                </tr>
                            @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @foreach($admins as $admin)
    <div id="adminModal-{{ $admin->id }}" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75 z-10 hidden">
        <div class="bg-white shadow-md rounded-lg p-6 mx-auto relative">
            <button class="font-bold absolute top-0 right-0 m-4 text-lg hover:text-red-500" onclick="closeAdminModal('{{ $admin->id }}')">X</button>
            <form action="{{ route('sadmin_updateadmin', $admin->id) }}" method="POST" class="grid grid-cols-2 gap-3">
                @csrf
                @method('PUT')
    
                <input type="hidden" name="id" id="adminEditId-{{ $admin->id }}" value="{{ $admin->id }}">
    
                <div class="mb-4">
                    <label for="name-{{ $admin->id }}" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name-{{ $admin->id }}" value="{{ old('name', $admin->name) }}" class="mt-1 p-2 capitalize border border-gray-300 rounded-md w-full" required>
                </div>
    
                <div class="mb-4">
                    <label for="email-{{ $admin->id }}" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email-{{ $admin->id }}" value="{{ old('email', $admin->email) }}" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                </div>
    
                <div class="mb-4">
                    <x-input-label for="password-{{ $admin->id }}" :value="__('Password')" />
    
                    <x-text-input id="password-{{ $admin->id }}" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    autocomplete="new-password"
                                    placeholder="Update Password" />
    
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
    
                <!-- Confirm Password -->
                <div class="mb-4">
                    <x-input-label for="password_confirmation-{{ $admin->id }}" :value="__('Confirm Password')" />
    
                    <x-text-input id="password_confirmation-{{ $admin->id }}" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation"
                                    autocomplete="new-password"
                                    placeholder="Update Password" />
    
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
    
                <input type="hidden" id="usertype-{{ $admin->id }}" name="usertype" value="admin">
    
                <div class="col-span-2 m-auto">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md">Update Admin</button>
                </div>
            </form>
        </div>
    </div>
    @endforeach
    
    
    <script>
        function openAdminModal(admin) {
            document.getElementById('adminEditId-' + admin.id).value = admin.id;
        
            // Set the values of the form fields to the old values or the current values of the admin
            document.getElementById('name-' + admin.id).value = admin.name;
            document.getElementById('email-' + admin.id).value = admin.email;
        
            // Show the modal
            document.getElementById('adminModal-' + admin.id).classList.remove('hidden');
        }
        
        function closeAdminModal(adminId) {
            // Clear the values of the form fields
            document.getElementById('name-' + adminId).value = '';
            document.getElementById('email-' + adminId).value = '';
        
            // Hide the modal
            document.getElementById('adminModal-' + adminId).classList.add('hidden');
        }
        </script>
    
    </div>



</x-app-layout>



   


<!-- List of staff members -->
{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Staff Information</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($staff as $staffMember)
                    <tr>
                        <td>{{ $staffMember->name }}</td>
                        <td>{{ $staffMember->email }}</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection --}}

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
                <form action="" method="POST" class="grid grid-cols-2 gap-3">
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
       


      
    </div>
    
    
    
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

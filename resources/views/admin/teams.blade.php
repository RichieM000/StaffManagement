<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <!-- Main content with sidebar -->
    <div class="flex">
        <x-sidebar /> <!-- Include the sidebar component -->

      <div class="flex-1 p-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="container mx-auto py-6">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold mb-4">Departments & Teams</h1>
                {{-- <a href="#" class="rounded bg-green-500 p-1.5 text-white hover:bg-green-700"><i class="ri-add-large-fill"></i> Add New</a> --}}
            </div>
            <p class="text-sm mb-1 font-light text-red-500">Read Only!</p>
            <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                <div class="overflow-x-auto">
                    {{-- <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700 uppercase text-sm font-medium leading-normal">
                                <th class="px-4 py-2 whitespace-nowrap">Kapitan</th>
                                <th class="px-4 py-2 whitespace-nowrap">Vice Kap</th>
                                <th class="px-4 py-2 whitespace-nowrap">Secretary</th>
                                <th class="px-4 py-2 whitespace-nowrap">Chairman</th>
                                <th class="px-4 py-2 whitespace-nowrap">Treasurer</th>
                                <th class="px-4 py-2 whitespace-nowrap">Kagawad</th>
                                <th class="px-4 py-2 whitespace-nowrap">Tanod</th>
                                <th class="px-4 py-2 whitespace-nowrap">SK</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @php
                            $jobRoles = ["Kapitan", "Vice Kap", "Secretary", "Chairman", "Treasurer", "Kagawad", "Tanod", "SK"];
                            @endphp
                            @foreach($staffData as $staff)
                            <tr class="border-b border-gray-200 transition duration-300 ease-in-out hover:bg-gray-100">
                                @foreach($jobRoles as $role)
                                <td class="px-4 py-2 whitespace-nowrap">
                                    @if($staff->jobrole == $role)
                                    {{$staff->firstname}} {{$staff->lastname}}
                                    @endif
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table> --}}


                  
                    

                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700 uppercase text-sm font-medium leading-normal">
                            
                                <th class="px-4 py-2 whitespace-nowrap">Chairman</th>
                                <th class="px-4 py-2 whitespace-nowrap">Secretary</th>
                                <th class="px-4 py-2 whitespace-nowrap">Treasurer</th>
                                <th class="px-4 py-2 whitespace-nowrap">Kagawad</th>
                                <th class="px-4 py-2 whitespace-nowrap">Tanod</th>
                                <th class="px-4 py-2 whitespace-nowrap">SK Chairman</th>
                                <th class="px-4 py-2 whitespace-nowrap">SK</th>
                                <th class="px-4 py-2 whitespace-nowrap">Barangay Health Workers</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            <tr class="transition text-center duration-300 ease-in-out hover:bg-gray-100">
                                <td class="">
                                    @foreach($staffData as $staff)
                                        @if($staff->jobrole == "Chairman")
                                      
                                            {{$staff->firstname}} {{$staff->lastname}}<br><br>
                                       
                                        @endif
                                    @endforeach
                                </td>
                                <td class="">
                                    @foreach($staffData as $staff)
                                        @if($staff->jobrole == "Secretary")
                                    
                                            {{$staff->firstname}} {{$staff->lastname}}<br><br>
                                       
                                        @endif
                                    @endforeach
                                </td>
                               
                                <td class="">
                                    @foreach($staffData as $staff)
                                        @if($staff->jobrole == "Treasurer")
                                            {{$staff->firstname}} {{$staff->lastname}}<br><br>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="">
                                    @foreach($staffData as $staff)
                                        @if($staff->jobrole == "Kagawad")
                                            {{$staff->firstname}} {{$staff->lastname}}<br><br>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="">
                                    @foreach($staffData as $staff)
                                        @if($staff->jobrole == "Tanod")
                                            {{$staff->firstname}} {{$staff->lastname}}<br><br>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="">
                                    @foreach($staffData as $staff)
                                        @if($staff->jobrole == "SKchairman")
                                            {{$staff->firstname}} {{$staff->lastname}}<br><br>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="">
                                    @foreach($staffData as $staff)
                                        @if($staff->jobrole == "SK")
                                            {{$staff->firstname}} {{$staff->lastname}}<br><br>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="">
                                    @foreach($staffData as $staff)
                                        @if($staff->jobrole == "BHW")
                                            {{$staff->firstname}} {{$staff->lastname}}<br><br>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    

                    {{-- <table class="w-full table-auto"> <thead> <tr class="bg-gray-200 text-gray-700 uppercase text-sm font-medium leading-normal"> <th class="px-4 py-2 whitespace-nowrap">Kapitan</th> <th class="px-4 py-2 whitespace-nowrap">Vice Kap</th> <th class="px-4 py-2 whitespace-nowrap">Secretary</th> <th class="px-4 py-2 whitespace-nowrap">Chairman</th> <th class="px-4 py-2 whitespace-nowrap">Treasurer</th> <th class="px-4 py-2 whitespace-nowrap">Kagawad</th> <th class="px-4 py-2 whitespace-nowrap">Tanod</th> <th class="px-4 py-2 whitespace-nowrap">SK</th> </tr> </thead> <tbody class="text-gray-600 text-sm font-light"> <tr> <td> @foreach($staffData as $staff) @if($staff->jobrole == "Kapitan") {{$staff->firstname}} {{$staff->lastname}} @break @endif @endforeach </td> <td> @foreach($staffData as $staff) @if($staff->jobrole == "Vice Kap") {{$staff->firstname}} {{$staff->lastname}} @break @endif @endforeach </td> <td> @foreach($staffData as $staff) @if($staff->jobrole == "Secretary") {{$staff->firstname}} {{$staff->lastname}} @break @endif @endforeach </td> <td> @foreach($staffData as $staff) @if($staff->jobrole == "Chairman") {{$staff->firstname}} {{$staff->lastname}} @break @endif @endforeach </td> <td> @foreach($staffData as $staff) @if($staff->jobrole == "Treasurer") {{$staff->firstname}} {{$staff->lastname}} @break @endif @endforeach </td> <td> @foreach($staffData as $staff) @if($staff->jobrole == "Kagawad") {{$staff->firstname}} {{$staff->lastname}} @break @endif @endforeach </td> <td> @foreach($staffData as $staff) @if($staff->jobrole == "Tanod") {{$staff->firstname}} {{$staff->lastname}} @break @endif @endforeach </td> <td> @foreach($staffData as $staff) @if($staff->jobrole == "SK") {{$staff->firstname}} {{$staff->lastname}} @break @endif @endforeach </td> </tr> </tbody>
                    </table> --}}
                </div>
            </div>
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

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row">
            <h2 class="font-semibold leading-tight
                    grow
                   text-xl text-gray-800 dark:text-gray-200">
                {{ __('Users') }}
            </h2>
            <p>
                <a href="{{ route('users.create') }}"
                   class="rounded-lg p-2 bg-blue-900 text-white
                        hover:bg-blue-100 hover:text-blue-900
                        transition ease-in-out duration-500"
                >Add New User</a>
            </p>
        </div>
    </x-slot>
    <h1 class="text-3xl
    p-6 pt-0 mb-4
    text-green-600
    bg-stone-200
    dark:text-green-200 dark:bg-stone-800">Users</h1>
    @if(session()->has('created'))
        <div class="w-full p-2 m-0 mb-6">
            <p class="w-full p-4 bg-green-500 text-white rounded">
                <i class="text-xl fa fa-check-circle text-green-200 bg-green-800 rounded-full mr-4 p-2"></i>
                The User "{{ session()->get('created') }} was created successfully.
            </p>
        </div>
    @endif
    @if(session()->has('deleted'))
        <div class="w-full p-2 m-0 mb-6">
            <p class="w-full p-4 bg-purple-500 text-white rounded">
                <i class="fa fa-check-circle text-purple-200 bg-purple-800 rounded-full mr-4 p-2"></i>
                The user "{{ session()->get('deleted') }} was deleted successfully.
            </p>
        </div>
    @endif
    <table class="table w-full text-gray-900 dark:text-gray-200 ">
        <thead>
        <tr class="bg-stone-900 text-stone-300">
            <th class="p-2 text-left">Row</th>
            <th class="p-1 px-2 text-left">Name</th>
            <th class="p-1 px-2 text-left">Passwords</th>
            <th class="p-1 px-2 text-left">Emails</th>
            <th class="p-1 px-2 text-left">Roles</th>
            <th class="p-2 text-left">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td class="p-2 px-2">{{$loop->index + 1}}</td>
                <td class="p-2 px-2">{{$user->name}}</td>

                <td class="p-2 px-2">{{ Str::limit($user->password, 7) }}</td>
                <td class="p-2 px-2"> {{$user->email}}</td>
                <td>
                    @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                            <label class="badge badge-success">{{ $v }}</label>
                        @endforeach
                    @endif
                </td>


                <td class="p-2">

                    <a href="{{route('users.show',$user)}}"
                       class="text-center p-2 grow rounded-l-md
               bg-green-500 text-white dark:bg-green-800
                hover:bg-green-900 dark:hover:bg-green-500
                transition ease-in-out
                duration-350">            <i class="fa fa-eye" ></i>
                        <span class="sr-only">Show</span></a>

                    <a href="{{route('users.edit',['user'=>$user])}}"
                       class="text-center p-2 grow
               bg-orange-500 text-white dark:bg-orange-800
                hover:bg-orange-900 dark:hover:bg-orange-500
                transition ease-in-out
                duration-350">            <i class="fa fa-edit" ></i>
                        <span class="sr-only">Edit</span></a>

                    <a href="{{route('users.delete',['user'=>$user])}}"
                       class="text-center p-2 grow rounded-r-md
               bg-red-500 text-white dark:bg-red-800
                hover:bg-red-900 dark:hover:bg-red-500
                transition ease-in-out
                duration-350">            <i class="fa fa-times" ></i>
                        <span class="sr-only">Delete</span></a>
                </td>
            </tr>
        @endforeach

        </tbody>
        <tfoot>
        <tr>
            <td colspan="4" class="p-1">
                {{ $users->links() }}
            </td>
        </tr>
        </tfoot>

    </table>
</x-app-layout>




{{--@extends('layouts.app')--}}

{{--@push('style')--}}
{{--    <style type="text/css">--}}
{{--        .my-active span{--}}
{{--            background-color: #5cb85c !important;--}}
{{--            color: white !important;--}}
{{--            border-color: #5cb85c !important;--}}
{{--        }--}}
{{--        ul.pager>li {--}}
{{--            display: inline-flex;--}}
{{--            padding: 5px;--}}
{{--        }--}}
{{--    </style>--}}
{{--@endpush--}}
{{--@section('content')--}}
{{--    <div class="container">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-md-6">--}}
{{--                <div class="card p-2 mb-2" style="font-weight: 700">Users CRUD Tutorial With Image / File Upload - Laravelia</div>--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header" style="background: gray; color:#f1f7fa; font-weight:bold;">--}}
{{--                        Users List--}}
{{--                        <a href="{{ route('user.create') }}" class="btn btn-success btn-xs py-0 float-end">+ Create New</a>--}}
{{--                    </div>--}}
{{--                    @if(session('message'))--}}
{{--                        <div class="alert alert-{{ session('status') }} alert-dismissible fade show" role="alert">--}}
{{--                            <strong>{{ session('message') }}</strong>--}}
{{--                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                    <div class="card-body">--}}
{{--                        <table class="table-responsive" style="width: 100%">--}}
{{--                            <thead>--}}
{{--                            <th>#</th>--}}
{{--                            <th>Name</th>--}}
{{--                            <th>Email</th>--}}

{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($users as $user)--}}
{{--                                <tr>--}}
{{--                                    <td>{{ $loop->index + 1 }}</td>--}}
{{--                                    <td>{{ $user->name }}</td>--}}
{{--                                    <td>{{ $user->email }}</td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                        <center class="mt-5">--}}
{{--                            {{  $users->links() }}--}}
{{--                        </center>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

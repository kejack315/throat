<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row">
            <h2 class="font-semibold leading-tight
                    grow
                   text-xl text-gray-800 dark:text-gray-200">
                {{ __('Roles') }}
            </h2>
            <p>
                <a href="{{ route('roles.create') }}"
                   class="rounded-lg p-2 bg-blue-900 text-white
                        hover:bg-blue-100 hover:text-blue-900
                        transition ease-in-out duration-500"
                >Add New Roles</a>
            </p>
        </div>
    </x-slot>
    <h1 class="text-3xl
    p-6 pt-0 mb-4
    text-green-600
    bg-stone-200
    dark:text-green-200 dark:bg-stone-800">Roles Management</h1>
    @if(session()->has('created'))
        <div class="w-full p-2 m-0 mb-6">
            <p class="w-full p-4 bg-green-500 text-white rounded">
                <i class="text-xl fa fa-check-circle text-green-200 bg-green-800 rounded-full mr-4 p-2"></i>
                The Roles "{{ session()->get('created') }} was created successfully.
            </p>
        </div>
    @endif
    @if(session()->has('deleted'))
        <div class="w-full p-2 m-0 mb-6">
            <p class="w-full p-4 bg-purple-500 text-white rounded">
                <i class="fa fa-check-circle text-purple-200 bg-purple-800 rounded-full mr-4 p-2"></i>
                The Roles "{{ session()->get('deleted') }} was deleted successfully.
            </p>
        </div>
    @endif
    <table class="table w-full text-gray-900 dark:text-gray-200 mb-10">
        <thead>
        <tr class="bg-stone-900 text-stone-300">
            <th class="p-2 text-left">Row</th>
            <th class="p-1 px-2 text-left">Roles</th>
            <th class="p-1 px-2 text-left">Permissions</th>
            <th class="p-2 text-left">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $role)
            <tr class="border-b">
                <td class="p-2 px-2">{{$loop->index + 1}}</td>
                <td class="p-2 px-2">{{$role->name}}</td>
                <td class="p-2 px-2">
                    <div class="flex flex-wrap gap-2 "> <!-- 使用flex容器和gap来确保行间距 -->
                        @foreach($role->permissions as $permission)
                            <span class="px-2 py-1 rounded bg-gray-200 text-gray-700">{{ $permission->name }}</span>
                        @endforeach
                    </div>
                </td>

                <td class="p-2 px-2 flex">

                    <a href="{{route('roles.show',$role)}}"
                       class="text-center p-2 grow rounded-l-md
               bg-green-500 text-white dark:bg-green-800
                hover:bg-green-900 dark:hover:bg-green-500
                transition ease-in-out
                duration-350">            <i class="fa fa-eye" ></i>
                        <span class="sr-only">Show</span></a>

                    <a href="{{route('roles.edit',['role'=>$role])}}"
                       class="text-center p-2 grow
               bg-orange-500 text-white dark:bg-orange-800
                hover:bg-orange-900 dark:hover:bg-orange-500
                transition ease-in-out
                duration-350">            <i class="fa fa-edit" ></i>
                        <span class="sr-only">Edit</span></a>

                    <a href="{{route('roles.destroy',['role'=>$role])}}"
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
            <td colspan="4" class="p-2">
                {{ $roles->links() }}
            </td>
        </tr>
        </tfoot>

    </table>
</x-app-layout>



{{--<x-app-layout>--}}

{{--        <div class="row">--}}
{{--            <div class="col-lg-12 margin-tb">--}}
{{--                <div class="pull-left">--}}
{{--                    <h2>Role Management</h2>--}}
{{--                </div>--}}
{{--                <div class="pull-right">--}}
{{--                    @can('role-create')--}}
{{--                        <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a>--}}
{{--                    @endcan--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}



{{--        @if ($message = Session::get('success'))--}}
{{--            <div class="alert alert-success">--}}
{{--                <p>{{ $message }}</p>--}}
{{--            </div>--}}
{{--        @endif--}}



{{--        <table class="table table-bordered">--}}

{{--            <tr>--}}
{{--                <th>No</th>--}}
{{--                <th>Name</th>--}}
{{--                <th width="280px">Action</th>--}}
{{--            </tr>--}}

{{--            @foreach ($roles as $key => $role)--}}

{{--                <tr>--}}
{{--                    <td>{{ ++$i }}</td>--}}
{{--                    <td>{{ $role->name }}</td>--}}
{{--                    <td>--}}
{{--                        <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>--}}
{{--                        @can('role-edit')--}}
{{--                            <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>--}}
{{--                        @endcan--}}
{{--                        @can('role-delete')--}}
{{--                            {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}--}}
{{--                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}--}}
{{--                            {!! Form::close() !!}--}}
{{--                        @endcan--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--        </table>--}}



{{--        {!! $roles->render() !!}--}}



{{--        <p class="text-center text-primary"><small>Tutorial by HDTuto.com</small></p>--}}

{{--</x-app-layout>--}}

@php

use App\Models\Permission;

$permission = Permission::all();
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Role Edit' }}
        </h2>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
    <div class="p-6 text-gray-900">

        <section>
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ 'role Edit' }}
                </h2>
        
                <p class="mt-1 text-sm text-gray-600">
                    {{ "role Edit" }}
                </p>
            </header>
        
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>
        
            <form method="post" action="{{ route('role-update') }}" class="mt-6 space-y-6">
                @csrf
        @method('PATCH')
                <div>
                    <x-input-label for="title" value='title' />
                    <x-text-input id="name" name="title" type="text" value="{{$role->name}}" class="mt-1 block w-full" required autofocus autocomplete="title" />
                    <x-input-error class="mt-2" :messages="$errors->get('title')" />
                </div>
        
                
                <div class="flex flex-wrap gap-4 mt-4" style="display:block">
                    @foreach ($permission as $permissions)
                    <label class="flex items-center">
                        <input id="name" name="Permission[]"
                        @foreach ($role->permissions as $per)
                        @if ($per->id == $permissions->id)
                            {{"checked"}}
                        @endif
                        @endforeach
                        value="{{$permissions->id}}" style="margin: 10px" type="checkbox" class="mt-1 mr-2"  />
                        <span>{{ $permissions->title }}</span>
                    </label>
                    @endforeach
                </div>
        
                <div class="flex items-center gap-4">
                    <x-primary-button>{{ "update" }}</x-primary-button>
                </div>
            </form>
        </section>
        
</div>
</div>

    </div>
</div>
</x-app-layout>

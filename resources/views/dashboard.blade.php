@php
use App\Models\Category;
// use Illuminate\Support\Facades\Auth;
$category = Category::all();
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6 mb-6">
                <div class="p-6 text-gray-900">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ 'you are login with : '. Auth::user()->name }}
                    </h2>
                </div>
            </div>    
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

       
            <section>
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ 'create post' }}
                    </h2>
            
                    <p class="mt-1 text-sm text-gray-600">
                        {{ "create your post" }}
                    </p>
                </header>
            
                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>
            
                <form method="post" action="{{ route('post-store') }}" class="mt-6 space-y-6">
                    @csrf
                    
            
                    <div>
                        <x-input-label for="title" value='title' />
                        <x-text-input id="name" name="title" type="text" class="mt-1 block w-full" required autofocus autocomplete="title" />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>
            
                    <div>
                        <x-input-label for="slug" value="slug" />
                        <x-text-input id="email" name="slug" type="text" class="mt-1 block w-full" required autocomplete="slug" />
                        <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                    </div>
     
                    <select class="form-control" name="category_id">
                        <option selected>انتخاب دسته‌بندی</option>
                        @foreach($category as $categor)
                            <option value="{{ $categor->id }}" {{ old('cat') == $categor->id ? 'selected' : '' }}>
                                {{ $categor->title }}
                            </option>
                        @endforeach
                    </select>
                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ "create" }}</x-primary-button>
            
                    </div>
                </form>
            </section>
        </div>
    </div>
    
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
            <div class="p-6 text-gray-900">

            <section>
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ 'create category' }}
                    </h2>
            
                    <p class="mt-1 text-sm text-gray-600">
                        {{ "create your category" }}
                    </p>
                </header>
            
                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>
            
                <form method="post" action="{{ route('cat-store') }}" class="mt-6 space-y-6">
                    @csrf
                    
            
                    <div>
                        <x-input-label for="title" value='title' />
                        <x-text-input id="name" name="title" type="text" class="mt-1 block w-full" required autofocus autocomplete="title" />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>
            
                  
                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ "create" }}</x-primary-button>
            
                    </div>
                </form>
            </section>
        </div>
    </div>
        </div>
    </div>
</x-app-layout>

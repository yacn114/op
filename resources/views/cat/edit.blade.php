@extends('layouts.app') <!-- مشخص کردن layout -->



@section('content') <!-- محتوای اصلی صفحه -->
@php

    $slot = "";
@endphp
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6 mb-6">
            <div class="p-6 text-gray-900">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ 'edit post' }}
                        </h2>
                
                        <p class="mt-1 text-sm text-gray-600">
                            {{ "edit your post" }}
                        </p>
                    </header>
                
                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                        @csrf
                    </form>
                
                    <form method="post" action="{{ route('category-update',[$category->id]) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')
                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                    <div class="alert alert-danger">
                        {{ session('success') }}
                    </div>
                @endif
                        <div>
                            <x-input-label for="title" value='title' />
                            <x-text-input id="name" name="title" type="text" value="{{$category->title}}" class="mt-1 block w-full" required autofocus autocomplete="title" />
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
@endsection
@extends('layouts.app') <!-- مشخص کردن layout -->
@section('content') <!-- محتوای اصلی صفحه -->
@php
    $slot = "";
@endphp
<style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }
    
    td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }
    
    tr:nth-child(even) {
      background-color: #dddddd;
    }
    </style>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6 mb-6">
            <div class="p-6 text-gray-900">
                <h1>Posts</h1>
                <br>
                yacn only can delete or edit role`s and permission`s...
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
                <table>
                  <tr>
                    <th>id</th>
                    <th>title</th>
                    <th>delete</th>
                    <th>edit</th>
                  </tr>
@foreach ($role as $roles)
    
<tr>
<td>{{$roles->id}}</td>
<td>{{$roles->name}}</td>
<td><form action="{{route('delete-role' ,[$roles->id])}}" method="post">
@csrf
@method('DELETE')
<button type="submit">delete</button>
</form></td>
<td><a href="{{route('role-edit',[$roles->id])}}">edit</a></td>
</tr>
@endforeach

                </table>
                
            </div>
            </div>
            </div>
        </div>
        @endsection
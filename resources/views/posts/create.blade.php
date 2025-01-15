@extends('posts.main')
@section('content')
  
        <!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap">
            <div class="container">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Create-Post</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->
        <style>
            .error-message {
    margin: auto;
    text-align: center;
    color: red;
}

        </style>
        <!-- Contact Start -->
        <div class="contact">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="contact-form">
                            <h2>create post</h2>
                            <form action="{{ route('post-store') }}" method="POST">
                                @if (count($errors->all()) > 0) 
                                @foreach ($errors->all() as $error)
                                <p style="margin: auto; text-align: center;" class="error-message">{{$error}}</p>
                                @endforeach
                                @endif
                                @csrf
                            
                                <div class="form-group">
                                    <input type="text" class="form-control" name="title" placeholder="title" />
                                </div>
                                <div class="form-group">
                                	<input type="text" class="form-control" name="slug" placeholder="slug" />
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="category_id">
                                        <option selected>انتخاب دسته‌بندی</option>
                                        @foreach($category as $categor)
                                            <option value="{{ $categor->id }}" {{ old('cat') == $categor->id ? 'selected' : '' }}>
                                                {{ $categor->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div><button class="btn" type="submit">Create</button></div>
                            </form>
                        </div>
                    </div>
             
                </div>
            </div>
        </div>
        <!-- Contact End -->
@endsection
@extends('posts.main')
@section('content')
<div class="contact">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="contact-form">
                    <h2>create category</h2>
<form action="{{ route('cat-store') }}" method="POST">
    @if (count($errors->all()) > 0) 
    @foreach ($errors->all() as $error)
    <p style="margin: auto; text-align: center;" class="error-message">{{$error}}</p>
    @endforeach
    @endif
    @csrf

    <div class="form-group">
        <input type="text" class="form-control" name="title" placeholder="title" />
    </div>
   
    </div>
    <div><button class="btn" type="submit">Create</button></div>
</form>
</div>
</div>

</div>
</div>
</div>
@endsection
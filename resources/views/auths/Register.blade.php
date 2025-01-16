@extends('posts.main')
@section('content')
<div class="contact">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="contact-form">
                    <h2>Register</h2>
<form action="{{ route('Register-store') }}" method="POST">
    @if (count($errors->all()) > 0) 
    @foreach ($errors->all() as $error)
    <p style="margin: auto; text-align: center;" class="error-message">{{$error}}</p>
    @endforeach
    @endif
    @csrf
    <div class="form-group">
        <input type="text" class="form-control" name="name" placeholder="name" />
    </div>
    <div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="email" />
    </div>
    <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="password" />
    </div>
    <div class="form-group">
        <input type="password" class="form-control" name="password_confirmation" placeholder="password_confirmation" />
    </div>
    <div><button class="btn" type="submit">Register</button></div>
    </div>
</form>
</div>
</div>

</div>
</div>
</div>
@endsection
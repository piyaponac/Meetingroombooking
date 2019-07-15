@extends('layouts.main') 
@section('title','Error | 500') 
@section('content')

<section id="wrapper" class="error-page">
        <div class="error-box">
            <div class="error-body text-center">
                <h1>500</h1>
                <h3 class="text-uppercase">Page Not Found !</h3>
                <p class="text-muted m-t-30 m-b-30">คุณไม่มีสิทธฺ์เข้าใช้งานในส่วนนี้</p>
                <a href="{{ url('/') }}" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">Back to home</a> </div>
            <footer class="footer text-center">© 2017 Material Pro.</footer>
        </div>
    </section>

@endsection
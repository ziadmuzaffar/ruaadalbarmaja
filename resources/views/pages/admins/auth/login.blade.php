@extends('layouts.admins.auth')
{{------------ Title ------------}}
@section('title')
    تسجيل الدخول
@endsection
{{------------ Auth ------------}}
@section('auth')
    {{------------ Login ------------}}
    <form class="login" action="{{route('admins.login')}}" method="post">
        @csrf
        {{------------ Logo ------------}}
        <img src="{{asset('public/images/system/logo.png')}}" alt="">
        {{------------ Heading ------------}}
        <h2>أكاديمية رواد البرمجة</h2>
        {{------------ Email ------------}}
        <div class="form-group">
            <label>البريد الإلكتروني</label>
            <i class="fa fa-envelope fa-fw"></i>
            <input type="email" name="email" autocomplete="off" required autofocus value="{{old('email')}}" class="form-control">
            @error('email')
                <span class="alert alert-danger">{{$message}}</span>
            @enderror
        </div> {{-- Email --}}
        {{------------ Password ------------}}
        <div class="form-group">
            <label>كلمة المرور</label>
            <i class="fa fa-lock fa-fw"></i>
            <input type="password" name="password" autocomplete="off" required class="form-control">
            <i class="fa fa-eye fa-fw" id="show-password"></i>
            @error('password')
                <span class="alert alert-danger">{{$message}}</span>
            @enderror
        </div> {{-- Password --}}
        {{------------ Submit ------------}}
        <button type="submit" class="btn btn-primary">
            دخول
        </button> {{-- Submit --}}
    </form> {{-- Login --}}
@endsection
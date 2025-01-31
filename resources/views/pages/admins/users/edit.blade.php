@extends('layouts.admins.template')
{{------------ Icon ------------}}
@section('icon')
    fa-edit
@endsection
{{------------ Title ------------}}
@section('title')
    تعديل المستخدم
@endsection
{{------------ Nav ------------}}
@section('nav')
    {{------------ Back ------------}}
    <li class="nav-item">
        {{------------ Link ------------}}
        <a class="nav-link btn btn-warning btn-sm" aria-current="page" href="{{route('admins.users.index')}}">
            <i class="fa fa-chevron-right fa-fw"></i>
            <span>رجوع</span>
        </a> {{-- Link --}}
    </li> {{-- Back --}}
@endsection
{{------------ Content ------------}}
@section('content')
    {{------------ Form ------------}}
    <form action="{{route('admins.users.update', $user->id)}}" method="post">
        @csrf @method('PUT')
        {{------------ ID ------------}}
        <input type="hidden" name="id" value="{{$user->id}}">
        {{------------ Row ------------}}
        <div class="row">
            {{------------ Full Name ------------}}
            <div class="col-md-6">
                {{------------ Group ------------}}
                <div class="form-group">
                    <label>الاسم الكامل</label>
                    <input type="text" name="full_name" autocomplete="off" class="form-control" required value="{{$user->full_name}}">
                    @error('full_name')
                        <span class="alert alert-danger">{{$message}}</span>
                    @enderror
                </div> {{-- Group --}}
            </div> {{-- Full Name --}}
            {{------------ Email ------------}}
            <div class="col-md-6">
                {{------------ Group ------------}}
                <div class="form-group">
                    <label>البريد الإلكتروني</label>
                    <input type="email" name="email" autocomplete="off" class="form-control" required value="{{$user->email}}">
                    @error('email')
                        <span class="alert alert-danger">{{$message}}</span>
                    @enderror
                </div> {{-- Group --}}
            </div> {{-- Email --}}
            {{------------ Password ------------}}
            <div class="col-md-6">
                {{------------ Group ------------}}
                <div class="form-group form-group-icons">
                    <label>كلمة المرور</label>
                    <input type="password" name="password" autocomplete="off" class="form-control">
                    @error('password')
                        <span class="alert alert-danger">{{$message}}</span>
                    @enderror
                </div> {{-- Group --}}
            </div> {{-- Password --}}
            {{------------ Password ------------}}
            <div class="col-md-6">
                {{------------ Group ------------}}
                <div class="form-group form-group-icons">
                    <label>تأكيد كلمة المرور</label>
                    <input type="password" name="password_confirmation" autocomplete="off" class="form-control">
                    @error('password_confirmation')
                        <span class="alert alert-danger">{{$message}}</span>
                    @enderror
                </div> {{-- Group --}}
            </div> {{-- Password --}}
            {{------------ Submit ------------}}
            <div class="col-12">
                {{------------ Button ------------}}
                <button type="submit" class="btn btn-success">
                    تحديث
                </button> {{-- Button --}}
            </div> {{-- Submit --}}
        </div> {{-- Row --}}
    </form> {{-- Form --}}
@endsection
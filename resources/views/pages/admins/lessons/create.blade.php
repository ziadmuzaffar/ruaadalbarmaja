@extends('layouts.admins.template')
{{------------ Icon ------------}}
@section('icon')
    fa-add
@endsection
{{------------ Title ------------}}
@section('title')
    إضافة درس
@endsection
{{------------ Nav ------------}}
@section('nav')
    {{------------ Back ------------}}
    <li class="nav-item">
        {{------------ Link ------------}}
        <a class="nav-link btn btn-warning btn-sm" aria-current="page" href="{{route('admins.lessons.index')}}">
            <i class="fa fa-chevron-right fa-fw"></i>
            <span>رجوع</span>
        </a> {{-- Link --}}
    </li> {{-- Back --}}
@endsection
{{------------ Content ------------}}
@section('content')
    {{------------ Form ------------}}
    <form action="{{route('admins.lessons.store')}}" method="post">
        @csrf
        {{------------ Row ------------}}
        <div class="row">
            {{------------ Ordering ------------}}
            <div class="col-sm-6">
                {{------------ Group ------------}}
                <div class="form-group">
                    <label>الترتيب</label>
                    <input type="number" name="ordering" autocomplete="off" class="form-control" required autofocus value="{{old('ordering')}}">
                    {{------------ Error ------------}}
                    @error('ordering')
                        {{------------ Alert ------------}}
                        <span class="alert alert-danger">
                            {{$message}}
                        </span> {{-- Alert --}}
                    @enderror
                </div> {{-- Group --}}
            </div> {{-- Ordering --}}
            {{------------ Name ------------}}
            <div class="col-sm-6">
                {{------------ Group ------------}}
                <div class="form-group">
                    <label>الاسم</label>
                    <input type="text" name="name" autocomplete="off" class="form-control" required value="{{old('name')}}">
                    {{------------ Error ------------}}
                    @error('name')
                        {{------------ Alert ------------}}
                        <span class="alert alert-danger">
                            {{$message}}
                        </span> {{-- Alert --}}
                    @enderror
                </div> {{-- Group --}}
            </div> {{-- Name --}}
            {{------------ Course ------------}}
            <div class="col-sm-6">
                {{------------ Group ------------}}
                <div class="form-group">
                    <label>الدورة</label>
                    <select name="course_id" class="form-control" required>
                        <option class="d-none"></option>
                        @foreach ($courses as $course)
                            <option value="{{$course->id}}" {{$course->id == old('course_id') ? 'selected' : ''}}>
                                {{$course->name}}
                            </option>
                        @endforeach
                    </select>
                    {{------------ Error ------------}}
                    @error('course_id')
                        {{------------ Alert ------------}}
                        <span class="alert alert-danger">
                            {{$message}}
                        </span> {{-- Alert --}}
                    @enderror
                </div> {{-- Group --}}
            </div> {{-- Course --}}
            {{------------ Url ------------}}
            <div class="col-sm-6">
                {{------------ Group ------------}}
                <div class="form-group">
                    <label>الرابط</label>
                    <input type="url" name="url" autocomplete="off" class="form-control" required value="{{old('url')}}">
                    {{------------ Error ------------}}
                    @error('url')
                        {{------------ Alert ------------}}
                        <span class="alert alert-danger">
                            {{$message}}
                        </span> {{-- Alert --}}
                    @enderror
                </div> {{-- Group --}}
            </div> {{-- Url --}}
            {{------------ Submit ------------}}
            <div class="col-12">
                {{------------ Button ------------}}
                <button type="submit" class="btn btn-primary">
                    إنشاء
                </button> {{-- Button --}}
            </div> {{-- Submit --}}
        </div> {{-- Row --}}
    </form> {{-- Form --}}
@endsection
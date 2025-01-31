@extends('layouts.admins.template')
{{------------ Icon ------------}}
@section('icon')
    fa-edit
@endsection
{{------------ Title ------------}}
@section('title')
    تعديل الدورة
@endsection
{{------------ Nav ------------}}
@section('nav')
    {{------------ Back ------------}}
    <li class="nav-item">
        {{------------ Link ------------}}
        <a class="nav-link btn btn-warning btn-sm" aria-current="page" href="{{route('admins.courses.index')}}">
            <i class="fa fa-chevron-right fa-fw"></i>
            <span>رجوع</span>
        </a> {{-- Link --}}
    </li> {{-- Back --}}
@endsection
{{------------ Content ------------}}
@section('content')
    {{------------ Form ------------}}
    <form action="{{route('admins.courses.update', $course->id)}}" method="post" enctype="multipart/form-data">
        @csrf @method('PUT')
        {{------------ ID ------------}}
        <input type="hidden" name="id" value="{{$course->id}}">
        {{------------ Row ------------}}
        <div class="row">
            {{------------ Image ------------}}
            <div class="col-sm-6">
                {{------------ Group ------------}}
                <div class="form-group">
                    <label>الصورة</label>
                    <input type="file" name="image" autocomplete="off" class="form-control">
                    {{------------ Error ------------}}
                    @error('image')
                        {{------------ Alert ------------}}
                        <span class="alert alert-danger">
                            {{$message}}
                        </span> {{-- Alert --}}
                    @enderror
                </div> {{-- Group --}}
            </div> {{-- Image --}}
            {{------------ Course ------------}}
            <div class="col-sm-6">
                {{------------ Group ------------}}
                <div class="form-group">
                    <label>الاسم</label>
                    <input type="text" name="name" autocomplete="off" class="form-control" required value="{{$course->name}}">
                    {{------------ Error ------------}}
                    @error('name')
                        {{------------ Alert ------------}}
                        <span class="alert alert-danger">
                            {{$message}}
                        </span> {{-- Alert --}}
                    @enderror
                </div> {{-- Group --}}
            </div> {{-- Course --}}
            {{------------ Ordering ------------}}
            <div class="col-sm-6">
                {{------------ Group ------------}}
                <div class="form-group">
                    <label>الترتيب</label>
                    <input type="number" name="ordering" autocomplete="off" class="form-control" required value="{{$course->ordering}}">
                    {{------------ Error ------------}}
                    @error('ordering')
                        {{------------ Alert ------------}}
                        <span class="alert alert-danger">
                            {{$message}}
                        </span> {{-- Alert --}}
                    @enderror
                </div> {{-- Group --}}
            </div> {{-- Ordering --}}
            {{------------ Track ------------}}
            <div class="col-sm-6">
                {{------------ Group ------------}}
                <div class="form-group">
                    <label>المسار</label>
                    {{------------ Select ------------}}
                    <select name="track_id" class="form-control" required>
                        <option class="d-none"></option>
                        @foreach ($tracks as $track)
                            <option value="{{$track->id}}" {{$track->id == $course->track_id ? 'selected' : ''}}>
                                {{$track->name}}
                            </option>
                        @endforeach
                    </select> {{-- Select --}}
                    {{------------ Error ------------}}
                    @error('track_id')
                        {{------------ Alert ------------}}
                        <span class="alert alert-danger">
                            {{$message}}
                        </span> {{-- Alert --}}
                    @enderror
                </div> {{-- Group --}}
            </div> {{-- Track --}}
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
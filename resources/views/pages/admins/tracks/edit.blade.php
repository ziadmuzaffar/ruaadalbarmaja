@extends('layouts.admins.template')
{{------------ Icon ------------}}
@section('icon')
    fa-edit
@endsection
{{------------ Title ------------}}
@section('title')
    تعديل المسار
@endsection
{{------------ Nav ------------}}
@section('nav')
    {{------------ Back ------------}}
    <li class="nav-item">
        {{------------ Link ------------}}
        <a class="nav-link btn btn-warning btn-sm" aria-current="page" href="{{route('admins.tracks.index')}}">
            <i class="fa fa-chevron-right fa-fw"></i>
            <span>رجوع</span>
        </a> {{-- Link --}}
    </li> {{-- Back --}}
@endsection
{{------------ Content ------------}}
@section('content')
    {{------------ Form ------------}}
    <form action="{{route('admins.tracks.update', $track->id)}}" method="post">
        @csrf @method('PUT')
        {{------------ ID ------------}}
        <input type="hidden" name="id" value="{{$track->id}}">
        {{------------ Row ------------}}
        <div class="row">
            {{------------ Icon ------------}}
            <div class="col-md-6">
                {{------------ Group ------------}}
                <div class="form-group">
                    <label>الايقونة</label>
                    <input type="text" name="icon" autocomplete="off" class="form-control" required value="{{$track->icon}}">
                    @error('icon')
                        <span class="alert alert-danger">{{$message}}</span>
                    @enderror
                </div> {{-- Group --}}
            </div> {{-- Icon --}}
            {{------------ Name ------------}}
            <div class="col-md-6">
                {{------------ Group ------------}}
                <div class="form-group">
                    <label>الاسم</label>
                    <input type="text" name="name" autocomplete="off" class="form-control" required value="{{$track->name}}">
                    @error('name')
                        <span class="alert alert-danger">{{$message}}</span>
                    @enderror
                </div> {{-- Group --}}
            </div> {{-- Name --}}
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
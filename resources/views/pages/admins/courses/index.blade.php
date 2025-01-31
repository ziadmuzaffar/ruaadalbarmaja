@extends('layouts.admins.template')
{{------------ Icon ------------}}
@section('icon')
    fa-video
@endsection
{{------------ Title ------------}}
@section('title')
    الدورات
@endsection
{{------------ Nav ------------}}
@section('nav')
    {{------------ Create ------------}}
    <li class="nav-item">
        {{------------ Link ------------}}
        <a class="nav-link btn btn-primary" aria-current="page" href="{{route('admins.courses.create')}}">
            <i class="fa fa-add fa-fw"></i>
            <span>إنشاء</span>
        </a> {{-- Link --}}
    </li> {{-- Create --}}
@endsection
{{------------ Content ------------}}
@section('content')
    {{------------ Row ------------}}
    <div class="row">
        @foreach ($courses as $course)
            {{------------ Track ------------}}
            <div class="col-lg-4 col-md-6">
                {{------------ Card ------------}}
                <div class="card">
                    {{------------ Head ------------}}
                    <div class="card-head">
                        {{------------ Edit ------------}}
                        <a href="{{route('admins.courses.edit', $course->id)}}">
                            <i class="fa fa-edit fa-fw"></i>
                        </a> {{-- Edit --}}
                        {{------------ Delete ------------}}
                        <a href="#delete" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fa fa-trash fa-fw"></i>
                        </a> {{-- Delete --}}
                        {{------------ Form ------------}}
                        <form action="{{route('admins.courses.destroy', $course->id)}}" method="post" class="d-none">
                            @csrf @method('DELETE')
                        </form> {{-- Form --}}
                    </div> {{-- Head --}}
                    {{------------ Body ------------}}
                    <div class="card-body">
                        {{------------ Image ------------}}
                        <img src="{{asset('public/images/courses/'.$course->image)}}" alt="{{$course->image}}">
                        {{------------ Title ------------}}
                        <h5 class="card-title">
                            {{$course->name}}
                        </h5> {{-- Title --}}
                        {{------------ Text ------------}}
                        <p class="card-text">
                            {{$course->track->name}}
                        </p> {{-- Text --}}
                    </div> {{-- Body --}}
                    {{------------ Foot ------------}}
                    <div class="card-foot">
                        {{------------ Foot ------------}}
                        <div class="card-foot-created-at">
                            {{$course->created_at}}
                        </div> {{-- Foot --}}
                    </div> {{-- Foot --}}
                </div> {{-- Card --}}
            </div>  {{-- Track --}}
        @endforeach
    </div> {{-- Row --}}
@endsection
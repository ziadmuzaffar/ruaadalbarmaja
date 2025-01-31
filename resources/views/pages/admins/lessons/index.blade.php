@extends('layouts.admins.template')
{{------------ Icon ------------}}
@section('icon') fa-clipboard @endsection
{{------------ Title ------------}}
@section('title')
    الدروس
@endsection
{{------------ Nav ------------}}
@section('nav')
    {{------------ Create ------------}}
    <li class="nav-item">
        {{------------ Link ------------}}
        <a class="nav-link btn btn-primary" aria-current="page" href="{{route('admins.lessons.create')}}">
            <i class="fa fa-add fa-fw"></i>
            <span>اضافة درس</span>
        </a> {{-- Link --}}
    </li> {{-- Create --}}
@endsection
{{------------ Content ------------}}
@section('content')
    {{------------ Row ------------}}
    <div class="row">
        @foreach ($lessons as $lesson)
            {{------------ Track ------------}}
            <div class="col-lg-4 col-md-6">
                {{------------ Card ------------}}
                <div class="card">
                    {{------------ Head ------------}}
                    <div class="card-head">
                        {{------------ Edit ------------}}
                        <a href="{{route('admins.lessons.edit', $lesson->id)}}">
                            <i class="fa fa-edit fa-fw"></i>
                        </a> {{-- Edit --}}
                        {{------------ Show ------------}}
                        <a href="{{$lesson->url}}"  target="_blank">
                            <i class="fa fa-eye fa-fw"></i>
                        </a> {{-- Show --}}
                        {{------------ Delete ------------}}
                        <a href="#delete" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fa fa-trash fa-fw"></i>
                        </a> {{-- Delete --}}
                        {{------------ Form ------------}}
                        <form action="{{route('admins.lessons.destroy', $lesson->id)}}" method="post" class="d-none">
                            @csrf @method('DELETE')
                        </form> {{-- Form --}}
                    </div> {{-- Head --}}
                    {{------------ Body ------------}}
                    <div class="card-body">
                        {{------------ Icon ------------}}
                        <div class="card-icon">
                            <i class="fa fa-clipboard fa-fw"></i>
                            <span>{{$lesson->ordering}}</span>
                        </div>
                        {{------------ Title ------------}}
                        <h5 class="card-title">
                            {{$lesson->name}}
                        </h5> {{-- Title --}}
                        {{------------ Text ------------}}
                        <p class="card-text">
                            {{$lesson->course->name}}
                        </p> {{-- Text --}}
                    </div> {{-- Body --}}
                </div> {{-- Card --}}
            </div>  {{-- Track --}}
        @endforeach
    </div> {{-- Row --}}
@endsection
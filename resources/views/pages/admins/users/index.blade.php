@extends('layouts.admins.template')
{{------------ Icon ------------}}
@section('icon') fa-users @endsection
{{------------ Title ------------}}
@section('title')
    المستخدمين
@endsection
{{------------ Nav ------------}}
@section('nav')
    {{------------ Create ------------}}
    <li class="nav-item">
        {{------------ Link ------------}}
        <a class="nav-link btn btn-primary" aria-current="page" href="{{route('admins.users.create')}}">
            <i class="fa fa-add fa-fw"></i>
            <span>اضافة</span>
        </a> {{-- Link --}}
    </li> {{-- Create --}}
@endsection
{{------------ Content ------------}}
@section('content')
    {{------------ Row ------------}}
    <div class="row">
        @foreach ($users as $user)
            {{------------ Track ------------}}
            <div class="col-lg-4 col-md-6">
                {{------------ Card ------------}}
                <div class="card">
                    {{------------ Head ------------}}
                    <div class="card-head">
                        {{------------ Edit ------------}}
                        <a href="{{route('admins.users.edit', $user->id)}}">
                            <i class="fa fa-edit fa-fw"></i>
                        </a> {{-- Edit --}}
                        {{------------ Delete ------------}}
                        <a href="#delete" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fa fa-trash fa-fw"></i>
                        </a> {{-- Delete --}}
                        {{------------ Form ------------}}
                        <form action="{{route('admins.users.destroy', $user->id)}}" method="post" class="d-none">
                            @csrf @method('DELETE')
                        </form> {{-- Form --}}
                    </div> {{-- Head --}}
                    {{------------ Body ------------}}
                    <div class="card-body">
                        {{------------ Icon ------------}}
                        <i class="fa fa-user fa-fw"></i>
                        {{------------ Title ------------}}
                        <h5 class="card-title">
                            {{$user->full_name}}
                        </h5> {{-- Title --}}
                        {{------------ Text ------------}}
                        <p class="card-text">
                            {{$user->email}}
                        </p> {{-- Text --}}
                    </div> {{-- Body --}}
                </div> {{-- Card --}}
            </div>  {{-- Track --}}
        @endforeach
    </div> {{-- Row --}}
@endsection
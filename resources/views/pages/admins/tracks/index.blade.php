@extends('layouts.admins.template')
{{------------ Icon ------------}}
@section('icon')
    fa-chart-gantt
@endsection
{{------------ Title ------------}}
@section('title')
    المسارات
@endsection
{{------------ Nav ------------}}
@section('nav')
    {{------------ Create ------------}}
    <li class="nav-item">
        {{------------ Link ------------}}
        <a class="nav-link btn btn-primary" aria-current="page" href="{{route('admins.tracks.create')}}">
            <i class="fa fa-add fa-fw"></i>
            <span>إنشاء</span>
        </a> {{-- Link --}}
    </li> {{-- Create --}}
@endsection
{{------------ Content ------------}}
@section('content')
    {{------------ Row ------------}}
    <div class="row">
        @foreach ($tracks as $item)
            {{------------ Track ------------}}
            <div class="col-lg-3 col-md-4 col-sm-6">
                {{------------ Card ------------}}
                <div class="card">
                    {{------------ Head ------------}}
                    <div class="card-head">
                        {{------------ Edit ------------}}
                        <a href="{{route('admins.tracks.edit', $item->id)}}">
                            <i class="fa fa-edit fa-fw"></i>
                        </a> {{-- Edit --}}
                        {{------------ Delete ------------}}
                        <a href="#delete" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fa fa-trash fa-fw"></i>
                        </a> {{-- Delete --}}
                        {{------------ Form ------------}}
                        <form action="{{route('admins.tracks.destroy', $item->id)}}" method="post" class="d-none">
                            @csrf @method('DELETE')
                        </form> {{-- Form --}}
                    </div> {{-- Head --}}
                    {{------------ Body ------------}}
                    <div class="card-body">
                        {{------------ Image ------------}}
                        <i class="fa fa-{{$item->icon}} fa-fw"></i>
                        {{------------ Title ------------}}
                        <h5 class="card-title">
                            {{$item->name}}
                        </h5> {{-- Title --}}
                    </div> {{-- Body --}}
                </div> {{-- Card --}}
            </div>  {{-- Track --}}
        @endforeach
    </div> {{-- Row --}}
@endsection
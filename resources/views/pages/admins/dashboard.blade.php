@extends('layouts.admins.template')
{{------------ Icon ------------}}
@section('icon')
    fa-chart-pie
@endsection
{{------------ Title ------------}}
@section('title')
    لوحة التحكم
@endsection
{{------------ Content ------------}}
@section('content')
    {{------------ Boards ------------}}
    @include('pages.admins.dashboard.boards')
    {{------------ Latest ------------}}
    @include('pages.admins.dashboard.latest')
@endsection
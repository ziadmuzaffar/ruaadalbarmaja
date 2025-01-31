@extends('layouts.users.template')
{{------------ Title ------------}}
@section('title')
    {{$lesson->course->name}} - {{$lesson->name}}
@endsection
{{------------ Content ------------}}
@section('content')
    {{------------ Landing Title ------------}}
    <header class="landing-title">
        {{------------ Container ------------}}
        <div class="container">
            <h1>{{$lesson->name}}</h1>
            <p>{{$lesson->course->name}}</p>
        </div> {{-- Container --}}
    </header> {{-- Landing Title --}}
    {{------------ Main ------------}}
    <main>
        {{------------ Lessons ------------}}
        <section class="lessons-show">
            {{------------ Container ------------}}
            <div class="container">
                {{------------ Row ------------}}
                <div class="row">
                    {{------------ Row ------------}}
                    <div class="col-sm-6">
                        {{------------ Git Hub ------------}}
                        <a href="#" target="_blank" class="lesson disabled">
                            <i class="fa-brands fa-github fa-fw"></i>
                            <span>كود الدرس</span>
                        </a>
                    </div> {{-- Git Hub --}}
                    {{------------ You Tube ------------}}
                    <div class="col-sm-6">
                        {{------------ Link ------------}}
                        <a href="{{$lesson->url}}" class="lesson" target="_blank">
                            <i class="fa-brands fa-youtube fa-fw"></i>
                            <span>مشاهدة الدرس</span>
                        </a> {{-- Link --}}
                    </div> {{-- You Tube --}}
                </div> {{-- Row --}}
            </div> {{-- Container --}}
        </section> {{-- Lessons --}}
    </main> {{-- Main --}}
@endsection
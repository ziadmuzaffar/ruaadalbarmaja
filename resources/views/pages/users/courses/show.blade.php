@extends('layouts.users.template')
{{------------ Title ------------}}
@section('title')
    {{$course->name}} - الدورات
@endsection
{{------------ Content ------------}}
@section('content')
    {{------------ Landing Title ------------}}
    <header class="landing-title">
        {{------------ Container ------------}}
        <div class="container">
            <h1>{{$course->name}}</h1>
            <p>{{$course->track->name}}</p>
        </div> {{-- Container --}}
    </header> {{-- Landing Title --}}
    {{------------ Main ------------}}
    <main>
        {{------------ Lessons ------------}}
        <section class="lessons">
            {{------------ Container ------------}}
            <div class="container">
                {{------------ Row ------------}}
                <div class="row" dir="ltr">
                    @foreach ($course->lessons as $lesson)
                        {{------------ Column ------------}}
                        <div class="col-lg-4 col-md-6">
                            {{------------ Lesson ------------}}
                            <div class="lesson">
                                <a href="{{$lesson->url}}" target="_blank">
                                    {{$lesson->name}}
                                </a>
                                <div>
                                    <span>#{{$lesson->ordering}}</span>
                                </div>
                            </div> {{-- Lesson --}}
                        </div> {{-- Column --}}
                    @endforeach
                </div> {{-- Row --}}
            </div> {{-- Container --}}
        </section> {{-- Lessons --}}
    </main> {{-- Main --}}
@endsection
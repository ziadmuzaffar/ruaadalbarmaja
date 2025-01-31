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
                    @for ($i = 0; $i < 20; $i++)
                        @foreach ($course->lessons as $lesson)
                            {{------------ Column ------------}}
                            <div class="col-lg-4 col-md-6">
                                {{------------ Lesson ------------}}
                                <div class="lesson">
                                    <a href="{{route('lessons.show', $lesson->id)}}">
                                        {{$lesson->name}}
                                    </a>
                                    <div>
                                        <span>#{{$lesson->ordering}}</span>
                                    </div>
                                </div> {{-- Lesson --}}
                            </div> {{-- Column --}}
                        @endforeach
                    @endfor
                </div> {{-- Row --}}
            </div> {{-- Container --}}
        </section> {{-- Lessons --}}
    </main> {{-- Main --}}
@endsection
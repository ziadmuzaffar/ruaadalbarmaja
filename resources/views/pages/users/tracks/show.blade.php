@extends('layouts.users.template')
{{------------ Title ------------}}
@section('title')
    {{$track->name}}
@endsection
{{------------ Content ------------}}
@section('content')
    {{------------ Landing Title ------------}}
    <header class="landing-title">
        {{------------ Container ------------}}
        <div class="container">
            <h1>{{$track->name}}</h1>
        </div> {{-- Container --}}
    </header> {{-- Landing Title --}}
    {{------------ Main ------------}}
    <main>
        {{------------ Courses ------------}}
        <section class="courses">
            {{------------ Container ------------}}
            <div class="container">
                {{------------ Row ------------}}
                <div class="row">
                    @foreach ($track->courses as $course)
                        <x-users.courses :course="$course" />
                    @endforeach
                </div> {{-- Row --}}
            </div> {{-- Container --}}
        </section> {{-- Courses --}}
    </main> {{-- Main --}}
@endsection
@extends('layouts.users.template')
{{------------ Title ------------}}
@section('title')
    الدورات
@endsection
{{------------ Content ------------}}
@section('content')
    {{------------ Landing Title ------------}}
    <header class="landing-title">
        {{------------ Container ------------}}
        <div class="container">
            <h1>الدورات التعليمية</h1>
            <p>سوف تجد هنا جميع الدورات التعليمية الموجودة في الاكاديمية</p>
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
                    @foreach ($courses as $course)
                        <x-users.courses :course="$course" />
                    @endforeach
                </div> {{-- Row --}}
            </div> {{-- Container --}}
        </section> {{-- Courses --}}
    </main> {{-- Main --}}
@endsection
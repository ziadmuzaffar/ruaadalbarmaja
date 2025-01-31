@extends('layouts.users.template')
{{------------ Title ------------}}
@section('title')
    المسارات
@endsection
{{------------ Content ------------}}
@section('content')
    {{------------ Landing Title ------------}}
    <header class="landing-title">
        {{------------ Container ------------}}
        <div class="container">
            <h1>المسارات التعليمية</h1>
            <p>سوف تجد هنا جميع المسارات التعليمية الموجودة في الاكاديمية</p>
        </div> {{-- Container --}}
    </header> {{-- Landing Title --}}
    {{------------ Main ------------}}
    <main>
        {{------------ Tracks ------------}}
        <section class="tracks">
            {{------------ Container ------------}}
            <div class="container">
                {{------------ Row ------------}}
                <div class="row">
                    @foreach ($tracks as $track)
                        <x-users.tracks :track="$track" />
                    @endforeach
                </div> {{-- Row --}}
            </div> {{-- Container --}}
        </section> {{-- Tracks --}}
    </main> {{-- Main --}}
@endsection
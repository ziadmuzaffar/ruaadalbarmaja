@include('layouts.admins.header')
{{------------ Warpper ------------}}
<div class="warpper">
    {{------------ Side Bar ------------}}
    <div class="sidebar">
        {{------------ Logo ------------}}
        <img src="{{asset('public/images/system/logo.png')}}" alt="">
        {{------------ Menu ------------}}
        <ul>
            {{------------ Dashboard ------------}}
            <li>
                {{------------ Link ------------}}
                <a href="{{route('admins.dashboard')}}">
                    <i class="fa fa-chart-pie fa-fw"></i>
                    <span>لوحة التحكم</span>
                </a> {{-- Link --}}
            </li> {{-- Dashboard --}}
            {{------------ Tracks ------------}}
            <li>
                {{------------ Link ------------}}
                <a href="{{route('admins.tracks.index')}}">
                    <i class="fa fa-chart-gantt fa-fw"></i>
                    <span>المسارات</span>
                </a> {{-- Link --}}
            </li> {{-- Tracks --}}
            {{------------ Courses ------------}}
            <li>
                {{------------ Link ------------}}
                <a href="{{route('admins.courses.index')}}">
                    <i class="fa fa-video fa-fw"></i>
                    <span>الدورات</span>
                </a> {{-- Link --}}
            </li> {{-- Courses --}}
            {{------------ Lessons ------------}}
            <li>
                {{------------ Link ------------}}
                <a href="{{route('admins.lessons.index')}}">
                    <i class="fa fa-clipboard fa-fw"></i>
                    <span>الدروس</span>
                </a> {{-- Link --}}
            </li> {{-- Lessons --}}
            {{------------ Users ------------}}
            <li>
                {{------------ Link ------------}}
                <a href="{{route('admins.users.index')}}">
                    <i class="fa fa-users fa-fw"></i>
                    <span>المستخدمين</span>
                </a> {{-- Link --}}
            </li> {{-- Users --}}
        </ul> {{-- Menu --}}
    </div> {{-- Side Bar --}}
    {{------------ Main Contant ------------}}
    <div class="main-content">
        {{------------ Top Bar ------------}}
        <div class="topbar">
            {{------------ Title ------------}}
            <div class="topbar-title">
                <img src="{{asset('public/images/system/logo.png')}}" alt="">
            </div> {{-- Title --}}
            {{------------ Actions ------------}}
            <div class="topbar-actions">
                {{------------ User ------------}}
                <div class="dropdown">
                    {{------------ Toggle ------------}}
                    <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i>
                    </button> {{-- Toggle --}}
                    {{------------ Menu ------------}}
                    <div class="dropdown-menu">
                        {{------------ Email ------------}}
                        <p>{{auth()->user()->email}}</p>
                        {{------------ Image ------------}}
                        <img src="{{asset('public/images/system/logo.png')}}" alt="logo">
                        {{------------ Name ------------}}
                        <p>
                            {{auth()->user()->full_name}}
                        </p> {{-- Name --}}
                        {{------------ Action ------------}}
                        <div>
                            {{------------ Profile ------------}}
                            <a href="{{route('admins.users.edit', auth()->user()->id)}}">
                                الملف الشخصي
                            </a> {{-- Profile --}}
                            {{------------ Website ------------}}
                            <a href="{{route('home')}}" target="_blank">
                                عرض الموقع
                            </a> {{-- Website --}}
                            {{------------ Logout ------------}}
                            <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">تسجيل الخروج</a>
                            {{------------ Form ------------}}
                            <form class="d-none" id="logout-form" action="{{route('logout')}}" method="post">
                                @csrf <input type="hidden" name="guard" value="web">
                            </form> {{-- Form --}}
                        </div> {{-- Action --}}
                    </div> {{-- Menu --}}
                </div> {{-- User --}}
            </div> {{-- Actions --}}
        </div> {{-- Top Bar --}}
        {{------------ Content ------------}}
        <div class="content">
            {{------------ Navbar ------------}}
            <nav class="navbar navbar-expand-lg bg-white">
                {{------------ Brand ------------}}
                <a class="navbar-brand" href="#">
                    <i class="fa @yield('icon') fa-fw"></i>
                    <span>@yield('title')</span>
                </a> {{-- Brand --}}
                {{------------  Toggler ------------}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button> {{-- Toggler --}}
                {{------------  Collapse ------------}}
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    {{------------  Nav ------------}}
                    <ul class="navbar-nav me-auto">
                        @yield('nav')
                    </ul> {{-- Nav --}}
                </div> {{-- Collapse --}}
            </nav> {{-- Navbar --}}
            @include('layouts.admins.alerts')
            @yield('content')
        </div> {{-- Contant --}}
    </div> {{-- Main Contant --}}
</div> {{-- Warpper --}}
@include('layouts.admins.footer')
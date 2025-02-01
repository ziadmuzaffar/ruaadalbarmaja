<!DOCTYPE html>
<html lang="ar">
    <head>
        <meta charset="UTF-8" />
        <title>@yield('title') - أكاديمية رواد البرمجة</title>
        <link rel="shortcut icon" href="{{asset('public/images/system/logo.png')}}" type="image/x-icon" />
        {{------------ Meta ------------}}
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        {{------------ CSS ------------}}
        <link rel="stylesheet" href="{{asset('public/assets/lib/normalize.css?ver=8.0.1')}}" />
        <link rel="stylesheet" href="{{asset('public/assets/lib/bootstrap.min.css?ver=5.3.0')}}" />
        <link rel="stylesheet" href="{{asset('public/assets/lib/all.min.css?ver=6.3.0')}}" />
        <link rel="stylesheet" href="{{asset('public/users/css/style.css?ver=0.0.1')}}" />
    </head>
    <body>
        {{------------ Navbar ------------}}
        <nav class="navbar navbar-expand-lg">
            {{------------ Container ------------}}
            <div class="container">
                {{------------ Brand ------------}}
                <a class="navbar-brand" href="{{route('home')}}">
                    <img src="{{asset('public/images/system/logo.png')}}" alt="logo">
                </a> {{-- Brand --}}
                {{------------  Toggler ------------}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button> {{-- Toggler --}}
                {{------------  Collapse ------------}}
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    {{------------  Nav ------------}}
                    <ul class="navbar-nav me-auto">
                        {{------------ Home ------------}}
                        <li class="nav-item">
                            {{------------ Link ------------}}
                            <a class="nav-link" aria-current="page" href="{{route('home')}}">
                                <i class="fa fa-home fa-fw"></i>
                                <span>الرئيسية</span>
                            </a> {{-- Link --}}
                        </li> {{-- Home --}}
                        {{------------ Tracks ------------}}
                        <li class="nav-item">
                            {{------------ Link ------------}}
                            <a class="nav-link" aria-current="page" href="{{route('tracks.index')}}">
                                <i class="fa fa-chart-gantt fa-fw"></i>
                                <span>المسارات</span>
                            </a> {{-- Link --}}
                        </li> {{-- Tracks --}}
                        {{------------ Courses ------------}}
                        <li class="nav-item">
                            {{------------ Link ------------}}
                            <a class="nav-link" aria-current="page" href="{{route('courses.index')}}">
                                <i class="fa fa-video fa-fw"></i>
                                <span>الدورات</span>
                            </a> {{-- Link --}}
                        </li> {{-- Courses --}}
                    </ul> {{-- Nav --}}
                </div> {{-- Collapse --}}
            </div> {{-- Container --}}
        </nav> {{-- Navbar --}}
        @yield('content')
        {{------------ Footer ------------}}
        <footer class="footer">
            <p>
                Made With Love By
                <a href="https://ziadmuzaffar.com">
                    Ziad Muzaffar
                </a>
                © {{date('Y')}}
            </p>
        </footer> {{-- Footer --}}
        <script src="{{asset('public/assets/lib/jquery.min.js?ver=3.6.3')}}"></script>
        <script src="{{asset('public/assets/lib/bootstrap.bundle.min.js?ver=5.3.3')}}"></script>
        <script src="{{asset('public/users/js/style.js?ver=0.0.1')}}"></script>
    </body>
</html>

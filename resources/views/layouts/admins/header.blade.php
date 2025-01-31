<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title') - أكاديمية رواد البرمجة</title>
        <link rel="shortcut icon" href="{{asset('images/system/logo.png')}}" type="image/x-icon">
        {{------------ Meta ------------}}
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{------------ CSS ------------}}
        <link rel="stylesheet" href="{{asset('public/assets/lib/normalize.css?ver=8.0.1')}}">
        <link rel="stylesheet" href="{{asset('public/assets/lib/bootstrap.min.css?ver=5.3.0')}}">
        <link rel="stylesheet" href="{{asset('public/assets/lib/all.min.css?ver=6.3.0')}}">
        <link rel="stylesheet" href="{{asset('public/admins/css/style.css?ver=0.0.1')}}">
    </head>
    <body>
        {{------------ Modals ------------}}
        @include('layouts.admins.modals')

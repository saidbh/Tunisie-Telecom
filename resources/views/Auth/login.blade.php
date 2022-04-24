{{--<!DOCTYPE html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--    <head>--}}
{{--        <meta charset="utf-8">--}}
{{--        <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--        <title>Laravel</title>--}}
{{--        <!-- Fonts -->--}}
{{--        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">--}}
{{--        <!-- Scripts -->--}}
{{--        <script src="{{ asset('js/app.js') }}" defer></script>--}}
{{--        <!-- Fonts -->--}}
{{--        <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}
{{--        <!-- Styles -->--}}
{{--        <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
{{--    </head>--}}
{{--    <body class="antialiased">--}}
{{--        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">--}}
{{--            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">--}}
{{--                <div class="flex justify-center mt-4 sm:items-center sm:justify-between">--}}
{{--                    <div class="container">--}}
{{--                        <div class="row justify-content-md-center">--}}
{{--                            <div class="col-md-4 justify-content-center">--}}
{{--                                @if (Session::has('error'))--}}
{{--                                    <div class="alert alert-danger m-0">{{ Session::get('error') }}</div>--}}
{{--                                @endif--}}
{{--                                @if (Session::has('success'))--}}
{{--                                    <div class="alert alert-success m-0">{{ Session::get('success') }}</div>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="container">--}}
{{--                        <div class="row justify-content-md-center">--}}
{{--                            <div class="col-md-4 justify-content-center">--}}
{{--                                <form action="{{route('login')}}" method="post" enctype="multipart/form-data">--}}
{{--                                    @csrf--}}
{{--                                    <div class="mb-3">--}}
{{--                                        <label for="email" class="form-label">Email address</label>--}}
{{--                                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">--}}
{{--                                        <div id="email" class="invalid-feedback">--}}
{{--                                            Please provide a valid city.--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="mb-3">--}}
{{--                                        <label for="password" class="form-label">Password</label>--}}
{{--                                        <input type="password" class="form-control" id="password" name="password">--}}
{{--                                    </div>--}}
{{--                                    <div class="mb-3 form-check">--}}
{{--                                        <input type="checkbox" class="form-check-input" name="remember_me" id="remember_me">--}}
{{--                                        <label class="form-check-label" for="exampleCheck1">Check me out</label>--}}
{{--                                    </div>--}}
{{--                                    <div class="d-grid gap-2">--}}
{{--                                        <button type="submit" class="btn btn-primary" type="button">Login</button>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </body>--}}
{{--</html>--}}
@extends('admin.master')
@section('content')
    <section class="sign-in-page bg-white">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-sm-6 align-self-center">
                    <div class="sign-in-from">
                        @if (Session::has('error'))
                            <div class="alert alert-danger m-0">{{ Session::get('error') }}</div>
                        @endif
                        @if (Session::has('success'))
                            <div class="alert alert-success m-0">{{ Session::get('success') }}</div>
                        @endif
                        <h1 class="mb-0">S'identifier</h1>
                        <p>Entrez votre adresse e-mail et votre mot de passe pour accéder au panneau d'administration.</p>
                            <form action="{{route('login')}}" method="post" enctype="multipart/form-data">
                                @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control mb-0" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mot de passe</label>
                            {{-- <a href="{{route('recover')}}" class="float-right">Mot de passe oublié?</a> --}}
                            <input type="password" name="password" class="form-control mb-0" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="d-inline-block w-100">
                            <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Se souvenir de moi</label>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">S'identifier</button>
                            </form>
                        </div>
                        <div class="sign-info">
                            {{-- <span class="dark-color d-inline-block line-height-2">Vous n'avez pas un compte? <a href={{route('registration')}}>S'inscrire</a></span> --}}
                            <ul class="iq-social-media">
                                <li><a href="" target="_blank"><i class="ri-link"></i></a></li>
                                <li><a href="" target="_blank"><i class="ri-facebook-box-line"></i></a></li>
                                <li><a href="" target="_blank"><i class="ri-instagram-line"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 bg-primary text-center">
                    <div class="sign-in-detail text-white" style="background: url({{asset("assets/images/login/1.png")}}) no-repeat 0 0; background-size: cover; min-height:calc(100vh - 55px)">
                        {{-- <a class="sign-in-logo mb-5" href="#"><img src={{asset("assets/images/logo-white.png")}} class="img-fluid" alt="logo"></a> --}}
                        {{-- <div class="owl-carousel" data-autoplay="true" data-loop="true" data-nav="false" data-dots="true" data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1" data-items-mobile-sm="1" data-margin="0">
                          <div class="item">
                            <img src={{asset("assets/images/login/1.png")}} class="img-fluid mb-4" alt="logo">
                            <h4 class="mb-1 text-white">Manage your orders</h4>
                            <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                          </div>
                          <div class="item">
                            <img src={{asset("assets/images/login/1.png")}} class="img-fluid mb-4" alt="logo">
                            <h4 class="mb-1 text-white">Manage your orders</h4>
                            <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                          </div>
                          <div class="item">
                            <img src={{asset("assets/images/login/1.png")}} class="img-fluid mb-4" alt="logo">
                            <h4 class="mb-1 text-white">Manage your orders</h4>
                            <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                          </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .iq-footer{
            margin:0px;
        }
    </style>
@endsection

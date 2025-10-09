@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Welcome back, {{ Auth::user()->name }}! 🎉</h5>
                                <p class="mb-4">
                                    You have published <strong>{{ $newsCount }}</strong> news articles and manage <strong>{{ $userCount }}</strong> users.
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('admin/assets/img/illustrations/man-with-laptop-light.png') }}" height="129"
                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 order-1">
                <div class="row">

                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="d-flex justify-content-center align-items-center p-2 bg-primary text-white rounded px-3">
                                        <i class="bx bx-user"></i>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                            <a class="dropdown-item" href="{{ route('admin.users.index') }}">View User</a>
                                        </div>
                                    </div>
                                </div>
                                <span>User</span>
                                <h3 class="card-title text-nowrap mb-1">{{ $userCount }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="d-flex justify-content-center align-items-center p-2 bg-success text-white rounded px-3">
                                        <i class="bx bx-news"></i>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                            <a class="dropdown-item" href="{{ route('admin.post.index') }}">View News</a>
                                        </div>
                                    </div>
                                </div>
                                <span>News</span>
                                <h3 class="card-title text-nowrap mb-1">{{ $newsCount }}</h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
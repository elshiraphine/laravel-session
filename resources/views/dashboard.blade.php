@extends('master')

@section('content')
    {{-- <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Laravel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-white"> Welcome: {{ ucfirst(Auth()->user()->name) }} </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('logout') }}"> Logout </a>
                </li>
            </ul>
        </div>
    </nav> --}}

    <div class="container mt-3">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 m-auto">
                <form action="{{ url('logout') }}">
                    <div class="card shadow">
                        <div class="car-header bg-success pt-2">
                            <div class="card-title font-weight-bold text-white text-center"> User Login </div>
                        </div>

                        <div class="card-body">
                            <h4 class="text-center">Welcome: {{ ucfirst(Auth()->user()->name) }}</h4>
                            {{-- <h4 class="text-center">{{ ucfirst(Auth()->user()->name) }}</h4> --}}
                        </div>

                        <div class="card-footer d-inline-block">
                            <button type="submit" class="btn btn-danger">Logout</button>
                            {{-- <a href="{{ url('logout') }}"
                                    class="text-danger font-weight-bold"> Logout </a> --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

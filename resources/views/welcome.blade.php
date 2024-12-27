@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-light">
                    <div class="card-header text-center bg-primary text-white">
                        <h2>Welcome to Task Management System</h2>
                    </div>

                    <div class="card-body">
                        <p class="lead text-center">Manage your tasks with ease and stay organized!</p>

                        <div class="text-center mt-4">
                            <a href="{{ route('tasks.index') }}" class="btn btn-success btn-lg">Go to Tasks</a>
                            @guest
                                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login</a>
                                <a href="{{ route('register') }}" class="btn btn-warning btn-lg">Register</a>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

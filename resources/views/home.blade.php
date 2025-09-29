@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3>Dashboard</h3>
                    <a href="{{ route('tasks.index') }}" class="btn btn-light btn-sm"> Tasks List </a>
                </div>

                <div class="card-body">
                    @if(session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    <p>
                    <h2>Welcome {{ Auth::user()->name }}!</h2>
                    </p>
                    <p>
                    <h5>Your current tasks: <strong>{{ Auth::user()->tasks()->count() }}</strong></h5>
                    </p>
                    <p>
                    <h5> Completed tasks: <strong>{{ Auth::user()->tasks()->where('is_completed', true)->count() }}</strong></h5>
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

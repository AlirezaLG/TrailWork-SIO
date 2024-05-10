@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header me-3">{{ __('Show') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="list">
                            <div class="mb-2">
                                <span class="fw-bold me-2">{{ __('User name') }}: </span>
                                <span>{{ $row->user->name }}</span </div>
                            </div>
                            <div class="mb-2">
                                <span class="fw-bold me-2">{{ __('Date') }}: </span>
                                <span>{{ $row->date }}</span </div>
                            </div>
                            <div class="mb-2">
                                <span class="fw-bold me-2">{{ __('Start Time') }}: </span>
                                <span>{{ $row->start_time }}</span </div>
                            </div>
                            <div class="mb-2">
                                <span class="fw-bold me-2">{{ __('End Time') }}: </span>
                                <span>{{ $row->date }}</span </div>
                            </div>

                            <div class="mb-2">
                                <span class="fw-bold me-2">{{ __('Work Time') }}: </span>
                                <span>{{ $row->work_time }}</span </div>
                            </div>

                            <div class="mb-2">
                                <span class="fw-bold me-2">{{ __('Project Name') }}: </span>
                                <span>{{ $row->project->name }}</span </div>
                            </div>
                            <a href="{{ route('tma.index') }}" class="btn btn-primary mt-4">{{ __('Back') }}</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

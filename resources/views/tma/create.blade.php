@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header ">{{ __('Create Time Log') }}</div>


                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="post" action="{{ route('tma.store') }}">
                            @csrf

                            <div class="row ">
                                <div class="mb-3 col-6">
                                    <label class="form-label">Date</label>
                                    <input type="text" name="date" class="form-control date">

                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label">Select a project {list come from DB}</label>
                                    <select name="project_id" class="form-select ">
                                        <option value="1" disabled>Projects</option>
                                        @foreach ($projects as $project)
                                            <option value={{ $project->id }}>
                                                {{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label">Start Time</label>
                                    <input name="start_time" type="text" class="form-control time">
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label">End Time</label>
                                    <input name="end_time" type="text" class="form-control time">
                                </div>
                                <div class="px-3">
                                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

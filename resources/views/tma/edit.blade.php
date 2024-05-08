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
                        <form method="post" action="{{ route('tma.update', $row->id) }}">
                            @method('PUT')
                            @csrf

                            <div class="row ">
                                <div class="mb-3 col-6">
                                    <label class="form-label">Date</label>
                                    <input type="text" name="date" class="form-control date"
                                        value={{ $row->date }}>
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label">Select a project</label>
                                    <select name="project_id" class="form-select ">
                                        <option disabled>Select Projects</option>
                                        @foreach ($projects as $project)
                                            <option {{ $row->project_id == $project->id ? 'selected' : '' }}
                                                value={{ $project->id }}>
                                                {{ $project->name }}</option>
                                        @endforeach


                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label">Start Time</label>
                                    <input name="start_time" type="text" class="form-control time"
                                        value={{ $row->start_time }}>
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label">End Time</label>
                                    <input name="end_time" type="text" class="form-control time"
                                        value={{ $row->end_time }}>
                                </div>
                                <div class="px-3">
                                    <input type="hidden" name='id' value={{ $row->id }} />
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

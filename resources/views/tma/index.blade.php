@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Time Management App - Home Page') }}</div>

                    <div class="card-body">
                        @foreach (['create', 'update', 'delete', 'error'] as $key)
                            @if (session($key))
                                <div class="alert alert-{{ $key == 'error' || $key == 'delete' ? 'danger' : 'success' }}"
                                    role="alert">
                                    {{ session($key) }}
                                </div>
                            @endif
                        @endforeach

                        @if ($rows->isNotEmpty())
                            <div class="form-control p-2">
                                <h3>Reports</h3>

                                <div class="row mb-1">
                                    <div class="col-4">
                                        <div class="bg-primary p-3 rounded text-center">
                                            <p class="fs-1 text-white">{{ $rows[0]->work_time }}</p>
                                            <p class="text-white">Today</p>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="bg-primary p-3 rounded text-center">
                                            <p class="fs-1 text-white">{{ $weeklyTime }}</p>
                                            <p class="text-white">Weekly 5/7</p>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="bg-primary p-3 rounded text-center">
                                            <p class="fs-1 text-white">{{ $monthlyTime }}</p>
                                            <p class="text-white">Monthly 20/30</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <a href="{{ route('tma.create') }}" class="btn btn-lg fs-6 btn-danger my-3"> Create </a>

                        @if ($rows->isNotEmpty())
                            <a href="{{ route('tma.export') }}"
                                class="btn btn-lg btn-secondary fs-6 my-3 float-end">{{ __('Export to CSV') }}
                            </a>
                            <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Project</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Start Time</th>
                                        <th scope="col">End Time</th>
                                        <th scope="col">Work Time</th>
                                        <th scope="col" class="text-center">CRUD</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rows as $row)
                                        <tr>
                                            <td scope="col">{{ $loop->index + 1 }}</td>
                                            <td scope="col">{{ $row->user->name }}</td>
                                            <td scope="col">{{ $row->project->name }}</td>
                                            <td scope="col">{{ $row->date }}</td>
                                            <td scope="col">{{ $row->start_time }}</td>
                                            <td scope="col">{{ $row->end_time }}</td>
                                            <td scope="col">{{ $row->work_time }}</td>
                                            <td scope="col" class="text-center">
                                                <a href="{{ route('tma.show', $row->id) }}"
                                                    class="btn btn-sm btn-primary">{{ __('View') }}</a>
                                                <a href="{{ route('tma.edit', $row->id) }}"
                                                    class="btn btn-sm btn-warning">{{ __('Edit') }}</a>
                                                <form class="d-inline" action="{{ route('tma.destroy', $row->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this record?')">
                                                        {{ __('Delete') }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <h2>{{ __('There are no records to show') }}</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header ">{{ __('Time Managment App - Index page') }}</div>


                    <div class="card-body">
                        @if (session('create'))
                            <div class="alert alert-success" role="alert">
                                {{ session('create') }}
                            </div>
                        @endif

                        @if (session('update'))
                            <div class="alert alert-success" role="alert">
                                {{ session('update') }}
                            </div>
                        @endif

                        @if (session('delete'))
                            <div class="alert alert-success" role="alert">
                                {{ session('delete') }}
                            </div>
                        @endif

                        <div class="form-control p-2">
                            <h3>Reports</h3>
                            <p>*For first 5 days/records, Weekly and monthly are equal but that period it change.(fastest
                                solution for now, I will upgrade it if I find time)
                            </p>
                            <div class="row mb-1">
                                <div class="col-4">
                                    <div class="bg-primary p-3 rounded text-center">
                                        <p class="fs-1 text-white">{{ $table[0]->work_time }}</p>
                                        <p class="text-white">last day</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="bg-primary p-3 rounded text-center">
                                        <p class="fs-1 text-white">{{ $weeklyTime }}</p>
                                        <p class="text-white">weekly 5/7</p>
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
                        <div class=" flex">
                            <a href={{ route('tma.create') }} class=" btn btn-lg fs-6 btn-danger my-3 "> Create </a>
                            <a href={{ route('tma.export') }}
                                class="btn btn-lg btn-secondary fs-6 my-3 float-end">{{ __('Export to CSV') }}
                            </a>
                        </div>

                        @if ($table)
                            <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Project</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Start time</th>
                                        <th scope="col">End time</th>
                                        <th scope="col">Work time</th>
                                        <th scope="col" class="text-center">CRUD</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($table as $row)
                                        <tr>
                                            <td scope="col">{{ $loop->index + 1 }}</td>
                                            <td scope="col">{{ $row->uname }}</td>
                                            <td scope="col">{{ $row->pname }}</td>
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
                                                    <input type="hidden" name={{ $row->id }} />
                                                    <input type="submit" class="btn btn-sm btn-danger"
                                                        value={{ __('Delete') }} />
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <h2>{{ __('There is no data to show') }}</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

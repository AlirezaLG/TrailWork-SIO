@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header ">{{ __('Projects') }}</div>
                    <div class="card-body">

                        @foreach (['create', 'update', 'delete', 'error'] as $key)
                            @if (session($key))
                                <div class="alert alert-{{ $key == 'error' ? 'danger' : 'success' }}" role="alert">
                                    {{ session($key) }}
                                </div>
                            @endif
                        @endforeach

                        <div class=" flex">
                            <a href={{ route('projects.create') }} class=" btn btn-lg fs-6 btn-danger my-3 "> Create
                                Project
                            </a>

                        </div>


                        @if (count($rows) > 0)
                            <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Project ID</th>
                                        <th scope="col">Project Name</th>
                                        <th scope="col">Total working time</th>
                                        <th scope="col" class="text-center">CRUD</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rows as $row)
                                        <tr>
                                            <td scope="col">{{ $loop->index + 1 }}</td>
                                            <td scope="col">{{ $row->id }}</td>
                                            <td scope="col">{{ $row->name }}</td>
                                            <td scope="col  ">
                                                <div class="btn btn-sm btn-secondary">
                                                    {{ $totalTimesPerProject[$loop->index] }}
                                                </div>
                                            </td>


                                            <td scope="col" class="text-center">
                                                <a href="{{ route('projects.edit', $row->id) }}"
                                                    class="btn btn-sm btn-warning">{{ __('Edit') }}</a>

                                                <form class="d-inline" action="{{ route('projects.destroy', $row->id) }}"
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

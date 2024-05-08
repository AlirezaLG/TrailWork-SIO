@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header ">{{ __('Dashboard') }}</div>


                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <p class="mb-3">
                            {{ __('If I had enough time I will work on project CRUD operation, At moment, table created and data read from database for Time log') }}
                        </p>

                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Project ID</th>
                                    <th scope="col">Project Name</th>
                                    <th scope="col" class="text-center">CRUD</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $row)
                                    <tr>
                                        <td scope="col">{{ $loop->index + 1 }}</td>
                                        <td scope="col">{{ $row->id }}</td>
                                        <td scope="col">{{ $row->name }}</td>

                                        <td scope="col" class="text-center">
                                            <a href="#" class="btn btn-sm btn-primary">{{ __('View') }}</a>
                                            <a href="#" class="btn btn-sm btn-warning">{{ __('Edit') }}</a>
                                            <a href="#" class="btn btn-sm btn-danger" />{{ __('Delete') }}</a>


                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

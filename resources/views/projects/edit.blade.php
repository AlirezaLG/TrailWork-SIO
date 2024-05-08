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
                        <form method="post" action="{{ route('projects.update', $row->id) }}">
                            @method('PUT')
                            @csrf

                            <div class="row ">
                                <div class="mb-3 col-12">
                                    <label class="form-label">Project Name</label>
                                    <input type="text" name="name" value="{{ $row->name }}"
                                        class="form-control w-100 ">
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

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Project summary') }}</div>
                    <div class="card-body">
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
                            </div>
                        @endif

                        <div class="summary-wrapper lh-1">
                            <p>Project: <strong>{{ $project->name }}</strong></p>
                            <p>Number of groups: <strong>{{ $project->groups }}</strong></p>
                            <p>Students per group: <strong>{{ $project->per_group }}</strong></p>
                        </div>

                        <div class="students-wrapper mt-4">
                            <h2>Students</h2>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Student</th>
                                    <th scope="col">Group</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($students as $student)
                                    <tr>
                                        <td>{{ $student->name }}</td>
                                        <td>-</td>
                                        <td><a href="{{ route('student.destroy', $student->id) }}">Delete</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">There are no students</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <a href="{{ route('student.create') }}" class="btn btn-primary">Add new student</a>
                        </div>

                        <div class="groups-wrapper mt-4">
                            <h2>Groups</h2>
                            <div class="row col-8">
                                @forelse($groups as $group)
                                    <div class="col-6 mb-4">
                                        <div class="card text-center">
                                            <div class="card-header">Group #{{ $group->id }}</div>
                                            <div class="card-body">
                                                <div class="dropdown">
                                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Dropdown link
                                                    </a>

                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="alert alert-light">
                                        There are no groups in project
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

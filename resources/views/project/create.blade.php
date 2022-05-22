@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create project') }}</div>
                    <div class="card-body">
                        <form method="post" action="{{ route('project.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="project_title" class="form-label">Project title</label>
                                <input type="text" class="form-control" id="project_title" name="project_title" value="{{old('project_title')}}" required>
                                @error('project_title')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="number_of_groups" class="form-label">Number of groups</label>
                                        <input type="number" class="form-control" id="number_of_groups" name="number_of_groups" value="{{old('number_of_groups')}}" required>
                                        @error('number_of_groups')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="students_per_group" class="form-label">Students per group</label>
                                        <input type="number" class="form-control" id="students_per_group" name="students_per_group" value="{{old('students_per_group')}}" required>
                                        @error('students_per_group')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

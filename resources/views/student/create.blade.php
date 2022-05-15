@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add student') }}</div>
                    <div class="card-body">
                        <form method="post" action="{{ route('student.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="student_name" class="form-label">Student name</label>
                                <input type="text" class="form-control" id="student_name" name="student_name" value="{{old('student_name')}}">
                                @error('student_name')
                                <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

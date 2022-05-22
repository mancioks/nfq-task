@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Project list') }}</div>
                    <div class="card-body">
                        <div class="actions mb-3">
                            <a href="{{ route('project.create') }}" class="btn btn-primary">{{ __('Create project') }}</a>
                        </div>
                        <ul class="list-group">
                            @forelse($projects as $project)
                                <li class="list-group-item">
                                    <a href="{{ route('project.show', $project->id) }}">{{ $project->name }}</a>
                                </li>
                            @empty
                                <li class="list-group-item">{{ __('No projects created') }}</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

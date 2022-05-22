<div class="row col-8">
    @forelse($project->groups as $group)
        <div class="col-6 mb-4">
            <div class="card text-center">
                <div class="card-header">{{ $group->name }}</div>
                <div class="card-body">
                    @foreach($group->students as $student)
                        <div class="btn btn-light w-100 mb-2 pe-none">
                            {{ $student->name }}
                        </div>
                    @endforeach
                    @for($i = 0; $i < $group->empty_slots; $i++)
                        <div class="dropdown mb-2">
                            <a class="btn btn-secondary dropdown-toggle w-100" href="#"
                               role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                               aria-expanded="false">
                                {{ __('Assign student') }}
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                @forelse($project->unasigned_students as $student)
                                    <li><a class="dropdown-item"
                                           href="{{ route('student.assign', [$student->id, $group->id]) }}">{{ $student->name }}</a>
                                    </li>
                                @empty
                                    <li><a class="dropdown-item" href="#">{{ __('No students') }}</a>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-light">
            {{ __('There are no groups in project') }}
        </div>
    @endforelse
</div>

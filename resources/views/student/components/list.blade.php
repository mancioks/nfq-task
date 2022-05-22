<table class="table">
    <thead>
    <tr>
        <th scope="col">{{ __('Student') }}</th>
        <th scope="col">{{ __('Group') }}</th>
        <th scope="col">{{ __('Actions') }}</th>
    </tr>
    </thead>
    <tbody>
    @forelse($project->students as $student)
        <tr>
            <td>{{ $student->name }}</td>
            <td>{{ $student->groups()->exists() ? $student->group->name : '-' }}</td>
            <td>
                <form method="post" action="{{ route('student.destroy', $student->id) }}" onsubmit="return confirm('{{ __('Are you sure?') }}');">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="3">{{ __('There are no students') }}</td>
        </tr>
    @endforelse
    </tbody>
</table>

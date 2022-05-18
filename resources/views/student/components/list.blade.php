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
            <td>{{ $student->group ? 'Group #'.$student->group->id : '-' }}</td>
            <td>
                <a href="{{ route('student.destroy', $student->id) }}" onclick="event.preventDefault();document.getElementById('student-delete-{{ $student->id }}').submit();">
                    {{ __('Delete') }}
                </a>
                <form id="student-delete-{{ $student->id }}" action="{{ route('student.destroy', $student->id) }}" method="POST">
                    @csrf
                    @method('delete')
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="3">There are no students</td>
        </tr>
    @endforelse
    </tbody>
</table>

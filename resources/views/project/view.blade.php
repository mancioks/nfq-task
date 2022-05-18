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

                        @if (Session::has('error'))
                            <div class="alert alert-danger">
                                <i class="fas fa-check-circle"></i> {{ Session::get('error') }}
                            </div>
                        @endif

                        <div class="summary-wrapper lh-1">
                            <p>Project: <strong>{{ $project->name }}</strong></p>
                            <p>Number of groups: <strong>{{ $project->groups }}</strong></p>
                            <p>Students per group: <strong>{{ $project->per_group }}</strong></p>
                        </div>

                        <div class="students-wrapper mt-4">
                            <h2>Students</h2>
                            <div id="students_component_wrapper">@include('student.components.list')</div>
                            <button class="btn btn-primary" id="add_student_button">Add new student</button>
                            <div id="add_student_form" class="mt-3 d-none">
                                <label for="student_name" class="form-label">Student name:</label>
                                <input type="text" class="form-control w-25 d-inline-block ms-2" id="student_name"
                                       name="student_name">
                                <button class="btn btn-primary" id="add_button">Add</button>
                                <div id="student_form_response" class="col-6"></div>
                            </div>
                        </div>

                        <div class="groups-wrapper mt-4">
                            <h2>Groups</h2>
                            <div id="groups_component_wrapper">@include('project.components.groups')</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const add_student_form = document.getElementById('add_student_form');
        const add_student_button = document.getElementById('add_student_button');
        const add_button = document.getElementById('add_button');
        const student_form_response = document.getElementById('student_form_response');

        add_student_button.addEventListener('click', function () {
            add_student_form.classList.toggle('d-none');
        });

        add_button.addEventListener('click', function () {
            var value = document.getElementById('student_name').value;

            const data = {student_name: value};

            fetch('{{ route('api.student.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(data),
            })
                .then(response => response.json())
                .then(data => {
                    console.log('Response:', data);

                    if (!data.errors) {
                        student_form_response.innerHTML = '<div class="alert alert-success mt-3">Student ' + data.name + ' created successfully</div>';
                        document.getElementById('student_name').value = '';
                        refreshComponents();
                    } else {
                        student_form_response.innerHTML = '<div class="form-text text-danger">' + data.message + '</div>';
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                });

        });

        function refreshComponents() {
            loadcomponent('{{ route('student.component.list') }}', 'students_component_wrapper');
            loadcomponent('{{ route('project.component.groups') }}', 'groups_component_wrapper');
        }

        window.setInterval(refreshComponents, 10000);

        function loadcomponent(link, wrapper) {
            fetch(link)
                .then((response) => response.text())
                .then((text) => {
                    if(text !== document.getElementById(wrapper).innerHTML) {
                        document.getElementById(wrapper).innerHTML = text;
                    }
                });
        }

    </script>
@endsection

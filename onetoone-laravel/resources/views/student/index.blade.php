<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Student Records</title>
    <style>
    body, html {
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        margin-top: 40px;
        align-items: center;
    }

    h1 {
        text-align: center;
        margin-top: 30px;
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
    }

    .table-container {
        padding: 25px;
        width: 150%;
        margin-top: 50px;
    }

    table td {
        padding: 15px; 
    }

    .btn-create {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 14px;
        padding: 10px 20px;
        margin-top: 20px;
        margin-right: 20px;
    }
    </style>

</head>
<body>
    <a href="{{ route('student.create') }}" class="btn btn-success btn-create">Create</a>

    <h1>Student Records</h1>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 30%;">Student</th> 
                    <th style="width: 25%;">Academic</th> 
                    <th style="width: 25%;">Country</th> 
                    <th style="width: 20%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td>
                        <strong>Name:</strong> {{ $student->name }}<br>
                        <strong>Age:</strong> {{ $student->age }}<br>
                        <strong>Address:</strong> {{ $student->address }}
                    </td>
                    <td>
                        @if($student->academic)
                        <strong>Course:</strong> {{ $student->academic->course }}<br>
                        <strong>Year:</strong> {{ $student->academic->year }}
                        @endif
                    </td>
                    <td>
                        @if($student->country)
                        <strong>Continent:</strong> {{ $student->country->continent }}<br>
                        <strong>Country Name:</strong> {{ $student->country->country_name }}<br>
                        <strong>Capital:</strong> {{ $student->country->capital }}
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('student.edit', ['student' => $student])}}" class="btn btn-primary btn-sm me-2">Edit</a>
                            <button class="btn btn-danger btn-sm delete-student" data-id="{{ $student->id }}">Delete</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-EVSTQN3/az2x4zZQD8kh3H4zcgxiNl9AXi2H3K7PkD7xl9fmgk3VoZw6stZrUoW2" crossorigin="anonymous"></script>

    <script>
        document.querySelectorAll('.delete-student').forEach(button => {
            button.addEventListener('click', function() {
                const studentId = button.getAttribute('data-id');

                if (confirm('Are you sure you want to delete this student?')) {
                    fetch(`/students/${studentId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            window.location.reload();
                        } else {
                            console.error('Failed to delete student');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                }
            });
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Edit a Student</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px; 
            margin-top: 20px;
        }

        .container {
            padding: 20px;
            width: 500px;
        }

        form div {
            margin-bottom: 20px;
        }

        button[type="submit"] {
            width: 100%;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <h1>EDIT A STUDENT</h1>
    <div class="container">
    @if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
    <form action="{{ route('student.update', ['student' => $student]) }}" method="POST" class="border p-4 rounded">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{$student->name}}">
        </div>
        <div class="mb-3">
            <label for="age" class="form-label">Age:</label>
            <input type="text" name="age" id="age" class="form-control" placeholder="Age" value="{{$student->age}}">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address:</label>
            <input type="text" name="address" id="address" class="form-control" placeholder="Address" value="{{$student->address}}">
        </div>
        <div class="mb-3">
            <label for="course" class="form-label">Course:</label>
            <input type="text" name="academic[course]" id="course" class="form-control" placeholder="Course" value="{{ $student->academic ? $student->academic->course : '' }}">
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Year:</label>
            <input type="text" name="academic[year]" id="year" class="form-control" placeholder="Year" value="{{ $student->academic ? $student->academic->year : '' }}">
        </div>
        <div class="mb-3">
            <label for="continent" class="form-label">Continent:</label>
            <input type="text" name="country[continent]" id="continent" class="form-control" placeholder="Continent" value="{{ $student->country ? $student->country->continent : '' }}">
        </div>
        <div class="mb-3">
            <label for="country_name" class="form-label">Country:</label>
            <input type="text" name="country[country_name]" id="country_name" class="form-control" placeholder="Country" value="{{ $student->country ? $student->country->country_name : '' }}">
        </div>
        <div class="mb-3">
            <label for="capital" class="form-label">Capital:</label>
            <input type="text" name="country[capital]" id="capital" class="form-control" placeholder="Capital" value="{{ $student->country ? $student->country->capital : '' }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    </div>
</body>
</html>

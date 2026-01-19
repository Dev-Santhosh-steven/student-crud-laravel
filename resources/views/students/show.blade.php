<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Student</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<div class="container">

    <div class="top-bar">
        <h2>Student Details</h2>
        <a href="{{ route('students.index') }}" class="btn">Back</a>
    </div>

    <table>
        <tr>
            <th width="30%">Name</th>
            <td>{{ $student->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $student->email }}</td>
        </tr>
        <tr>
            <th>Phone</th>
            <td>{{ $student->phone }}</td>
        </tr>
    </table>

</div>

</body>
</html>

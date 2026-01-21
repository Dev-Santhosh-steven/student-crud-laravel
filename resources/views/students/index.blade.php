<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Management</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>

<div class="container">

@if(session('success'))
    <div id="flash-message" style="margin-bottom: 15px; color: green;">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(() => {
            const msg = document.getElementById('flash-message');
            if (msg) msg.style.display = 'none';
        }, 3000);
    </script>
@endif

<div id="ajax-message" style="margin-bottom: 15px; color: green; display:none;"></div>

    <div class="top-bar">
        <h2>Student List</h2>
        <div>
            <a href="{{ route('students.index') }}" class="btn">+ Add Student</a>
            <a href="{{ route('login') }}" class="logout btn">Logout</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th width="220">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
            <tr id="row-{{ $student->id }}">
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->phone }}</td>
                <td>
                    <a href="{{ route('students.show',$student->id) }}" class="btn">View</a>
                    <a href="{{ route('students.edit',$student->id) }}" class="btn">Edit</a>
                    <button onclick="deleteStudent({{ $student->id }})">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<script>
function deleteStudent(id) {
    if (!confirm('Are you sure you want to delete this student?')) return;

    fetch(`/students/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {

            document.getElementById(`row-${id}`).remove();

            const msg = document.getElementById('ajax-message');
            msg.innerText = data.message;
            msg.style.display = 'block';

            setTimeout(() => {
                msg.style.display = 'none';
            }, 3000);
        }
    });
}
</script>

</body>
</html>

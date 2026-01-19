<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Management</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
        }
        h2 {
            margin-bottom: 15px;
        }
        input {
            padding: 6px;
            margin-bottom: 8px;
            width: 100%;
        }
        button {
            padding: 6px 10px;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
        }
        th {
            background: #f1f1f1;
        }
        .logout {
            float: right;
            font-size: 14px;
        }
        .error {
            color: red;
        }
        .modal-bg {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
        }
        .modal {
            background: #fff;
            width: 400px;
            margin: 100px auto;
            padding: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">

    <a href="{{ url('/logout') }}" class="logout">Logout</a>

    <h2>Student List</h2>

    <form id="studentForm">
        @csrf
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="Phone" required>
        <button type="submit">Add Student</button>
        <div id="formError" class="error"></div>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Action</th>
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
                    <button onclick="viewStudent({{ $student->id }})">View</button>
                    <button onclick="editStudent({{ $student->id }})">Edit</button>
                    <button onclick="deleteStudent({{ $student->id }})">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<div class="modal-bg" id="modalBg">
    <div class="modal">
        <h3 id="modalTitle"></h3>

        <input type="hidden" id="student_id">

        <label>Name</label>
        <input type="text" id="modal_name">

        <label>Email</label>
        <input type="email" id="modal_email">

        <label>Phone</label>
        <input type="text" id="modal_phone">

        <br>
        <button id="updateBtn" onclick="updateStudent()">Update</button>
        <button onclick="closeModal()">Close</button>
    </div>
</div>

<script>
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

document.getElementById('studentForm').addEventListener('submit', function(e) {
    e.preventDefault();

    fetch('/students', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            name: this.name.value,
            email: this.email.value,
            phone: this.phone.value
        })
    }).then(() => location.reload());
});

function deleteStudent(id) {
    if (!confirm('Are you sure?')) return;

    fetch(`/students/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': csrfToken }
    }).then(() => document.getElementById(`row-${id}`).remove());
}

function viewStudent(id) {
    fetch(`/students/${id}`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('modalTitle').innerText = 'View Student';
            fillModal(data);
            document.getElementById('updateBtn').style.display = 'none';
            openModal();
        });
}

function editStudent(id) {
    fetch(`/students/${id}`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('modalTitle').innerText = 'Edit Student';
            fillModal(data);
            document.getElementById('updateBtn').style.display = 'inline';
            openModal();
        });
}

function updateStudent() {
    const id = document.getElementById('student_id').value;

    fetch(`/students/${id}`, {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            name: modal_name.value,
            email: modal_email.value,
            phone: modal_phone.value
        })
    }).then(() => location.reload());
}

function fillModal(data) {
    student_id.value = data.id;
    modal_name.value = data.name;
    modal_email.value = data.email;
    modal_phone.value = data.phone;
}

function openModal() {
    document.getElementById('modalBg').style.display = 'block';
}

function closeModal() {
    document.getElementById('modalBg').style.display = 'none';
}
</script>

</body>
</html>

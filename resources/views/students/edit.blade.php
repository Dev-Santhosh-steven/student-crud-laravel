<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<div class="container">

@if(session('success'))
    <div id="message" style="margin-bottom: 15px; color: green;">
        {{ session('success') }}
    </div>

    <script>

        setTimeout(() => {
            const messageDiv = document.getElementById('message');
            if (messageDiv) {
                messageDiv.style.display = 'none';
            }
        }, 3000);
    </script>
@endif

    <div class="top-bar">
        <h2>Edit Student</h2>
        <a href="{{ route('students.index') }}" class="btn">Back</a>
    </div>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<form method="POST" action="{{ route('students.update', $student->id) }}">
    @csrf
    @method('PUT')

        <label>Name</label>
        <input type="text" name="name" value="{{ old('name', $student->name) }}" required>

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $student->email) }}" required>

        <label>Phone</label>
        <input type="text" name="phone" value="{{ old('phone', $student->phone) }}" required>

        <div style="margin-top: 15px;">
            <button type="submit">Update Student</button>
            <a href="{{ url('/students') }}" class="btn">Cancel</a>
        </div>
    </form>

</div>

</body>
</html>

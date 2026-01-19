<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Student</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<div class="container">

    <div class="top-bar">
        <h2>Add Student</h2>
        <a href="{{ route('students.index') }}" class="btn">Back</a>
    </div>

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

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('students.store') }}">
        @csrf

        <label>Name</label>
        <input type="text" name="name" value="{{ old('name') }}" required>

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>Phone</label>
        <input type="text" name="phone" value="{{ old('phone') }}" required>

        <div style="margin-top: 15px;">
            <button type="submit">Save Student</button>
            <a href="{{ route('students.index') }}" class="btn">Cancel</a>
        </div>
    </form>

</div>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Welcome to Task Manager</h1>
        <p>This is a simple task management application built with Laravel.</p>
        <a href="{{ route('tasks.index') }}" class="btn btn-primary">Go to Task Manager</a>
    </div>
</body>
</html>

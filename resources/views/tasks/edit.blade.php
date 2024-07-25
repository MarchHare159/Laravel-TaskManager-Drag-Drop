@extends('layout')

@section('title', 'Edit Task')

@section('content')
    <h1>Edit Task</h1>

    <!-- Display success message if available -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form for editing the task -->
    <form method="POST" action="{{ route('tasks.update', $task) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="task-name">Task Name</label>
            <input type="text" id="task-name" name="name" class="form-control" value="{{ old('name', $task->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="task-priority">Priority</label>
            <input type="number" id="task-priority" name="priority" class="form-control" value="{{ old('priority', $task->priority) }}" required>
            @error('priority')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Task</button>
    </form>
@endsection

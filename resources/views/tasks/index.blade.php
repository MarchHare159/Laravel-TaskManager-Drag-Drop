@extends('layout')

@section('title', 'Task Manager')

@section('content')
    <h1 class="mb-4">Task Manager</h1>

    <!-- Display success message if available -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form for adding a new task -->
    <form method="POST" action="{{ route('tasks.store') }}" class="mb-4">
        @csrf
        <div class="form-group">
            <label for="task-name">Task Name</label>
            <input type="text" id="task-name" name="name" class="form-control" placeholder="Task Name" required>
        </div>
        <div class="form-group">
            <label for="task-priority">Priority</label>
            <input type="number" id="task-priority" name="priority" class="form-control" placeholder="Priority" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Task</button>
    </form>

    <!-- List of tasks -->
    <ul id="task-list" class="list-group">
        @foreach($tasks as $task)
            <li class="list-group-item d-flex justify-content-between align-items-center" data-id="{{ $task->id }}">
                {{ $task->name }}
                <div>
                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-info btn-sm mr-2">Edit</a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let taskList = document.getElementById('task-list');
        if (taskList) {
            new Sortable(taskList, {
                animation: 150,
                onEnd: function (evt) {
                    let order = Array.from(taskList.children).map((el, index) => {
                        return {
                            id: el.getAttribute('data-id'),
                            priority: index + 1
                        };
                    });
                    fetch('/tasks/reorder', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ order: order })
                    }).then(response => response.json())
                    .then(data => console.log('Success:', data))
                    .catch(error => console.error('Error:', error));
                }
            });
        }
    });
</script>
@endpush

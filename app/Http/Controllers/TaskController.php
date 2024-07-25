<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        // Fetch tasks from the database, optionally filtering by project if necessary
        $tasks = Task::orderBy('priority')->get();

        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function create()
    {
        // Return the view to create a new task
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'priority' => 'required|integer|min:1'
        ]);

        // Fetch the current tasks and their priorities
        $tasks = Task::orderBy('priority')->get();

        // Get the provided priority for the new task
        $newPriority = $request->input('priority');

        if ($newPriority > $tasks->count()) {
            // Set priority to the next available position if the provided priority is too high
            $newPriority = $tasks->count() + 1;
        }

        // Shift priorities of existing tasks to make space for the new task
        Task::where('priority', '>=', $newPriority)->increment('priority');

        // Create a new task
        Task::create([
            'name' => $request->input('name'),
            'priority' => $newPriority
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    public function edit(Task $task)
    {
        // Return the view to edit the specified task
        return view('tasks.edit', ['task' => $task]);
    }

    public function update(Request $request, Task $task)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'priority' => 'required|integer|min:1'
        ]);

        // Get the new priority and current priority
        $newPriority = $request->input('priority');
        $currentPriority = $task->priority;

        // Fetch the total number of tasks
        $totalTasks = Task::count();

        // If the new priority is greater than the total number of tasks, set it to the last position
        if ($newPriority > $totalTasks) {
            $newPriority = $totalTasks;
        }

        // Update the priorities if the new priority is different
        if ($newPriority != $currentPriority) {
            if ($newPriority < $currentPriority) {
                // Shift priorities down for tasks with higher priority than the new priority
                Task::whereBetween('priority', [$newPriority, $currentPriority - 1])->increment('priority');
            } else {
                // Shift priorities up for tasks with lower priority than the new priority
                Task::whereBetween('priority', [$currentPriority + 1, $newPriority])->decrement('priority');
            }

            // Update the task with the new priority
            $task->update([
                'name' => $request->input('name'),
                'priority' => $newPriority
            ]);
        } else {
            // Just update the task without changing priorities
            $task->update([
                'name' => $request->input('name')
            ]);
        }

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        // Get the priority of the task being deleted
        $deletedPriority = $task->priority;

        // Delete the task
        $task->delete();

        // Shift priorities of remaining tasks up to close the gap
        Task::where('priority', '>', $deletedPriority)->decrement('priority');

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }

    public function reorder(Request $request)
    {
        // Validate the request
        $request->validate([
            'order' => 'required|array',
            'order.*.id' => 'exists:tasks,id',
            'order.*.priority' => 'integer|min:1'
        ]);

        // Update the priorities of the tasks based on their new order
        foreach ($request->input('order') as $task) {
            Task::where('id', $task['id'])->update(['priority' => $task['priority']]);
        }

        return response()->json(['status' => 'success']);
    }
}

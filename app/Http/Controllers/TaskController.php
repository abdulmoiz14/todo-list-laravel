<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use DB;




class TaskController extends Controller
{
    /***!
     *
     * This Class is for Task computing */

    use AuthorizesRequests;

    //This function load the dashboard and load all the created tasks
    public function dashboard()
    {
        $tasks = auth()->user()->tasks;
        return view('tasks.dashboard', compact('tasks'));
    }

    // This function store or add new Task to the DB
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        try {
            auth()->user()->tasks()->create($request->only('title', 'description'));
            return redirect()->route('dashboard')->with('success', 'Task created successfully!');
        } catch (QueryException $e) {
            return redirect()->route('dashboard')->with('error', 'We are unable to create your task!')->withInput();
        }
    }

    //This function marks and updates task as complemented/uncompleted
    public function update(Request $request, Task $task)
    {
        try {
            $this->authorize('update', $task);
            $get_is_completed = ($task->is_completed == 0 ? 1 : 0);
            $task->update(['is_completed' => $get_is_completed]);
            return redirect()->route('dashboard')->with('success', 'Task updated successfully!');
        } catch (QueryException $e) {
            return redirect()->route('dashboard')->with('error', 'We are unable to update your record!');
        }
    }

    //This function delete any selected Task
    public function destroy(Task $task)
    {
        try {
            $this->authorize('delete', $task);
            $task->delete();
            return redirect()->route('dashboard')->with('success', 'Task deleted successfully!');
        } catch (QueryException $e) {
            return redirect()->route('dashboard')->with('error', 'We are unable to delete your record!');
        }
    }
}

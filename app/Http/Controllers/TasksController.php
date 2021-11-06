<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TasksController extends Controller
{
    public function index() {
        $tasks = Task::orderBy('completed','DESC')
            ->orderBy('id','DESC')
            ->get();
        return view('tasks.index', [
            'tasks' => $tasks,
            'title' => 'All tasks',
        ]);
    }

    public function ready() {
        $tasks = Task::where('completed', true)
            ->orderBy('id','DESC')
            ->get();
        return view('tasks.index', [
            'tasks' => $tasks,
            'title' => 'Ready tasks',
        ]);
    }

    public function todo() {
        $tasks = Task::where('completed', false)
            ->orderBy('id','DESC')
            ->get();
        return view('tasks.index', [
            'tasks' => $tasks,
            'title' => 'Todo tasks',
        ]);
    }

    public function create() {
        return view('tasks.create');
    }

    public function store() {
        try {
            request()->validate([
                'title' => 'required|max:40',
                'description' => 'required|max:255',
            ]);

            Task::create([
                'title' => request('title'),
                'description' => request('description'),
            ]);

            $task = Task::where('title', request('title'))
                ->where('description', request('description'))
                ->first();

            $message = "Task created(".$task->title.")";
        } catch(Exception $e) {
            $message = "Error with task creation(".$task->title.")";
        }

        $tasks = Task::orderBy('completed','DESC')
            ->orderBy('id','DESC')
            ->get();

        return view('tasks.index', [
            'tasks' => $tasks,
            'title' => 'Todo tasks',
            'message' => $message,
        ]);
    }

    public function update($id) {
        $task = Task::where('id', $id)->first();
        $task->completed = $task->completed == true ? false : true;
        try {
            $task->save();
            $message = "Task set completed(".$task->title.")";
        } catch(Exception $e) {
            $message = "Error with set complete(".$task->title.")";
        }
        return redirect()->back()->with('success', 'success *');
    }

    public function delete($id) {
        $task = Task::where('id', $id)->first();
        try {
            $task->delete();
            $message = "Task deleted(".$task->title.")";
        } catch(Exception $e) {
            $message = "Error with delete task(".$task->title.")";
        }
        return redirect()->back()->with('message', $message);
    }

    public function openEdit($id) {
        $task = Task::where('id', $id)->first();
        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    public function edit($id) {
        $task = Task::where('id', $id)->first();
        $task->description = request('description');
        $task->title = request('title');
        $task->save();
        return redirect('/');
    }
}

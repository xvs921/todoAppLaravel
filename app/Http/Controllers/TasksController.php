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
        ]);
    }

    public function ready() {
        $value = 1;
        $tasks = Task::where('completed'->$value)
            ->orderBy('id','DESC')
            ->get();
        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    public function todo() {
        $value = 0;
        $tasks = Task::where('completed'-> $value)
            ->orderBy('id','DESC')
            ->get();
        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    public function create() {
        return view('tasks.create');
    }

    public function store() {
        request()->validate([
            'description' => 'required|max:255',
        ]);
        
        Task::create([
            'description' => request('description'),
        ]);

        $this->index();
    }

    public function update() {

        $task = Task::where('id'->$id)->first();
        $task->completed = !$task->completed;
        $task->save();
        $this->index();
    }

    public function delete() {

        $task = Task::where('id'->$id)->first();
        $task->delete();
        $this->index();
    }
}

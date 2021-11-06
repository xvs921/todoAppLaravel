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
        request()->validate([
            'title' => 'required|max:50',
            'description' => 'required|max:255',
        ]);
        
        Task::create([
            'description' => request('description'),
        ]);

        return redirect('/');
    }

    public function update($id) {
        $task = Task::where('id', $id)->first();
        $task->completed = $task->completed == true ? false : true;
        $task->save();
        return redirect()->back()->with('success', 'success update');
    }

    public function delete($id) {
        $task = Task::where('id', $id)->first();
        $task->delete();
        return redirect()->back()->with('success', 'success delete');
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

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
        $alltasks = Task::orderBy('completed','DESC')
            ->orderBy('id','DESC')
            ->get();
        $tasks = [];
        foreach ($alltasks as $t) {
            if($t->completed == true) array_push($tasks,$t);
        }
        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    public function todo() {
        $alltasks = Task::orderBy('completed','DESC')
            ->orderBy('id','DESC')
            ->get();
        //$tasks = Task::where('completed'->false)->get();
        $tasks = [];
        foreach ($alltasks as $t) {
            if($t->completed == false) array_push($tasks,$t);
        }
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

    public function update($id) {
        $task = Task::where('id', $id)->first();
        $task->completed = $task->completed == true ? false : true;
        $task->save();
        $this->index();
    }

    public function delete($id) {
        $task = Task::where('id', $id)->first();
        return $task;
        //$task->delete();
        //$this->index();
    }
}

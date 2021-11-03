<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index() {
        return view('tasks.index');
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

        return redirect('/');
    }

}

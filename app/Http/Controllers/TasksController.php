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
			'title' => 'All Tasks',
		]);
	}

	public function ready() {
		$tasks = Task::where('completed', true)
			->orderBy('id','DESC')
			->get();
		return view('tasks.index', [
			'tasks' => $tasks,
			'title' => 'Ready Tasks',
		]);
	}

	public function todo() {
		$tasks = Task::where('completed', false)
			->orderBy('id','DESC')
			->get();
		return view('tasks.index', [
			'tasks' => $tasks,
			'title' => 'Todo Tasks',
		]);
	}

	public function newForm() {
		return view('tasks.create');
	}

	public function saveNew() {
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
			$message = "Error with create task(".$task->title.")";
		}

		$tasks = Task::orderBy('completed','DESC')
			->orderBy('id','DESC')
			->get();

		return view('tasks.index', [
			'tasks' => $tasks,
			'title' => 'All tasks',
			'message' => $message,
		]);
	}

	public function updateCompleted($id) {
		$task = Task::where('id', $id)->first();
		$task->completed = $task->completed == true ? false : true;
		try {
			$task->save();
			$message = "Task set completed(".$task->title.")";
		} catch(Exception $e) {
			$message = "Error with set complete(".$task->title.")";
		}
		return redirect()->back()->with('message', $message);
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

	public function editForm($id) {
		$task = Task::where('id', $id)->first();
		return view('tasks.edit', [
			'task' => $task,
		]);
	}

	public function edit($id) {
		$task = Task::where('id', $id)->first();
		try {
			$task->description = request('description');
			$task->title = request('title');
			$task->save();
			$message = "Task edited(".$task->title.")";
		} catch(Exception $e) {
			$message = "Error with edit task(".$task->title.")";
		}
		return redirect('/')->with('message', $message);
	}
}

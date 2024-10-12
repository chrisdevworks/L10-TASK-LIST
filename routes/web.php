<?php
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::fallback(function () {
    return 'Still got somewhere!';
});


Route::get('/', function (Task $task) {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
    return view('index', [
        'tasks' => Task::latest()->paginate(10)
    ]);
})->name('tasks.index');


Route::view('/tasks/create', 'create')
    ->name('tasks.create');


Route::get('/tasks/{task}/edit', action: function (Task $task) {
        // return view('show', ['task' => \App\Models\Task::findOrFail($id)]);
    return view('edit', [
        'task' => $task
    ]);
})->name('tasks.edit');


Route::get('/tasks/{task}', function (Task $task) {
    // return view('show', ['task' => \App\Models\Task::findOrFail($id)]);
    // return view('show', ['task' => Task::findOrFail($id)]);
    return view('show', [
        'task' => $task
    ]);
})->name('tasks.show');


Route::post('/tasks', function(TaskRequest $request) {
    // dd($request->all());
    // $data = $request->validate([
    //     'title' => 'required|max:10',
    //     'description' => 'required',
    //     'long_description' => 'required',
    // ]);

    // $task = new App\Models\Task;

    // $data = $request->validated();
    // $task = new Task;
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];

    // $task->save();

    $task = Task::create($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success','Task created successfully!');
})->name('tasks.store');


Route::put('/tasks/{task}', function(Task $task, TaskRequest $request) {
    // dd($request->all());
    // $data = $request->validate([
    //     'title' => 'required|max:10',
    //     'description' => 'required',
    //     'long_description' => 'required',
    // ]);

    // $task = new App\Models\Task;
    // $task = Task::findOrFail($id);

    // $data = $request->validated();
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();

    $task->update($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success','Task updated successfully!');
})->name('tasks.update');


Route::delete('/tasks/{task}', function(Task $task){
    $task->delete();

    return redirect()->route('tasks.index')
        ->with('success', 'Task deleted successfully!');
})->name('tasks.destroy');



Route::put('tasks/{task}/toggle-complete', function(Task $task){
    $task->toggleComplete();

    return redirect()->back()->with('success', 'Task updated successfully!');
})->name('tasks.toggle-complete');

// Route::get('/hello', function () {
//     return 'Hello';
// });

// Route::get('/hallo', function () {
//     return redirect()->route('welcome');
// });

// Route::get('/greet/{name}', function ($name) {
//  return 'Hello ' . $name . '!';
// });


// GET

// POST

// PUT

// DELETE

// Named Routes

// Route::get('/welcome', function () {
//     // return view('welcome');
//     return 'Welcome';
// })->name('welcome');

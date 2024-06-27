<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $today_tasks = $tasks = [];
    if (auth()->user()->todo_token) {
        $TaskApiService = new App\Services\TaskAPIService();
        $tasks = (new TaskController($TaskApiService))->index();

        // get all of the todos titles that are due today from the collection tasks
        foreach ($tasks as $task) {
            if (\Carbon\Carbon::parse($task->due_date)->isToday()) {
                $today_tasks[] = $task->title;
            }
        }
    }

    return view('dashboard', compact('tasks', 'today_tasks'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('tasks')->middleware('auth')->group(function () {
    Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/{task}', [TaskController::class, 'show'])->name('tasks.show');
    Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::prefix('subtasks')->group(function () {
        Route::patch('/{task}', [TaskController::class, 'subtasks_push'])->name('subtasks.push');
        Route::put('/{task}', [TaskController::class, 'subtask_update'])->name('subtasks.update');
    });
});

Route::get('/link/account', function () {
    return view('link_account');
})->middleware('auth')->name('link_account');

Route::post('/link/account', function (Request $request) {
    $user = auth()->user();

    // if password doesn't match, fail
    if (!Hash::check($request->password, $user->password)) {
        return back()->withErrors(['password' => 'Invalid password']);
    }

    $response = Http::withOptions([
        'verify' => false,
    ])->post(config('todo_api.url') . '/users/register', [
                'email' => $user->email,
                'username' => $user->name,
                'password' => $request->password,
            ]);
    $user->todo_token = $response->json()['token'];
    $user->save();
    return redirect()->route('link_account')->with('success', 'Account linked successfully!');

})->middleware('auth')->name('link_account.store');


require __DIR__ . '/auth.php';

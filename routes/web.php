<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->simplePaginate(3);
    //$jobs = Job::with('employer')->cursorPaginate(3);
    //$jobs = Job::with('employer')->Paginate(3);

    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

Route::get('jobs/create', function () {
    return view('jobs.create');
});
Route::post('/jobs', function () {
    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);

    return redirect('/jobs');
});

Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

    return view('jobs.show', ['job' => $job]);
});

//Route::post('/jobs', function () {
//    request()->validate([
//        'employer_id' => ['required', 'exists:employers'],
//        'title'       => ['required'],
//        'salary'      => ['required'],
//    ]);
//});
Route::get('/contact', function () {
    return view('contact');
});



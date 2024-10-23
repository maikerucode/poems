<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\PoemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\MockExamController;
use App\Http\Controllers\PDFExtractController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('chirps', ChirpController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('poems', PoemController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::get('/home', [PoemController::class, 'home'])
    ->name('home')
    ->middleware(['auth', 'verified']);

Route::resource('tags', TagController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('letters', LetterController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::get('/roadtorslp', [MockExamController::class, 'home'])
    ->name('exam.home')
    ->middleware(['auth', 'verified']);

Route::get('/roadtorslp/getQues/{id}', [MockExamController::class, 'singleQues'])
    ->name('exam.sampleQues')
    ->middleware(['auth', 'verified']);

Route::get('/roadtorslp/checkQues/{id}', [MockExamController::class, 'checkQues'])
    ->name('exam.checkQues')
    ->middleware(['auth', 'verified']);

Route::post('/roadtorslp/nextQues/', [MockExamController::class, 'nextQues'])
    ->name('exam.nextQues')
    ->middleware(['auth', 'verified']);

Route::get('/roadtorslp/import', [PDFExtractController::class, 'home'])
    ->name('exam.import')
    ->middleware(['auth', 'verified']);
    
Route::post('/roadtorslp/import/file_inp', [PDFExtractController::class, 'parseQuestions'])
->name('exam.importQues')
->middleware(['auth', 'verified']);

Route::get('/roadtorslp/end/{id}', [MockExamController::class, 'testEnd'])
    ->name('exam.testEnd')
    ->middleware(['auth', 'verified']);

Route::get('/roadtorslp/retry/{id}', [MockExamController::class, 'retryTest'])
->name('exam.testRetry')
->middleware(['auth', 'verified']);

Route::post('/roadtorslp/maketemptest', [MockExamController::class, 'makeTempTest'])
    ->name('exam.makeTemp')
    ->middleware(['auth', 'verified']);


Route::get('/auto-login/{user}', function ($user) {
    // Predefined email and password
    $email = env('AUTH_EMAIL_' . $user);
    $password = env('AUTH_PASS_' . $user);

    // Attempt to log in the user
    if (Auth::attempt(['email' => $email, 'password' => $password])) {
        // Login successful
        return redirect()->intended(route('dashboard'));
    } else {
        // Login failed
        return redirect()->back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }
})->name('auto-login');

require __DIR__.'/auth.php';

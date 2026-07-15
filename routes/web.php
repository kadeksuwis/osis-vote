<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CandidateController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\VoterController;
use App\Http\Controllers\VoteController;

Route::get('/', [VoteController::class, 'showLoginForm'])->name('vote.login');
Route::post('/vote/login', [VoteController::class, 'login'])->name('vote.login.submit');
Route::get('/vote/choose', [VoteController::class, 'choose'])->name('vote.choose');
Route::post('/vote/submit', [VoteController::class, 'submit'])->name('vote.submit');
Route::get('/vote/thanks', [VoteController::class, 'thanks'])->name('vote.thanks');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('candidates', CandidateController::class);

        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

        Route::resource('candidates', CandidateController::class);
        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

        Route::get('voters', [VoterController::class, 'index'])->name('voters.index');
        Route::post('voters/import', [VoterController::class, 'import'])->name('voters.import');
        Route::delete('voters/{voter}', [VoterController::class, 'destroy'])->name('voters.destroy');
    });
});

require __DIR__ . '/auth.php';

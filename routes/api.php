<?php

use App\Http\Controllers\PodcastNoteController;
use Illuminate\Support\Facades\Route;

Route::post('/podcast/notes', [PodcastNoteController::class, 'store']);
Route::get('/podcast/notes', [PodcastNoteController::class, 'index']);
Route::put('/podcast/notes/{id}', [PodcastNoteController::class, 'update']);
Route::delete('/podcast/notes/{id}', [PodcastNoteController::class, 'destroy']);
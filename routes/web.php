<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [UserController::class, 'contacts'])->name('contacts');
Route::get('/contacts', [UserController::class, 'contacts'])->name('contacts');
Route::post('/contact_list', [UserController::class, 'contactList'])->name('contact_list');

Route::get('/add_contact', [UserController::class, 'addContact'])->name('add_contact');
Route::post('/save_contact', [UserController::class, 'saveContact'])->name('save_contact');

Route::get('/edit_contact/{id}', [UserController::class, 'editContact'])->name('edit_contact');
Route::post('/update_contact/{id}', [UserController::class, 'updateContact'])->name('update_contact');

Route::post('/delete_contact', [UserController::class, 'deleteContact'])->name('delete_contact');

Route::post('/check_unique_contact', [UserController::class, 'checkUniqueContact'])->name('check_unique_contact');


Route::get('/import_contacts', [UserController::class, 'importContactFile'])->name('import_contacts');
Route::get('/download_file', [UserController::class, 'downloadExampleFile'])->name('download_file');
Route::post('/save_import_contacts', [UserController::class, 'importContacts'])->name('save_import_contacts');

Route::get('job_process/{batchId}', [UserController::class, 'getBatchData'])->name('job_process');
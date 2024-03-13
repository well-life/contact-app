<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactNoteController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\WelcomeController;
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

function getContacts()
{
    return [
        1 => ['id' => 1, 'name' => 'Name 1', 'phone' => '1234567890'],
        2 => ['id' => 2, 'name' => 'Name 2', 'phone' => '2345678901'],
        3 => ['id' => 3, 'name' => 'Name 3', 'phone' => '3456789012'],
    ];
}

Route::get('/', WelcomeController::class);

Route::controller(ContactController::class)->name('contacts.')->group(function () {
    Route::get('/contact', 'index')->name('index');
    Route::get('/contact/create', 'create')->name('create');
    Route::get('/contact/show/{id}', 'show')->name('show');
});

Route::resource('/companies', CompanyController::class);

Route::resources([
    '/tags' => TagController::class,
    '/tasks' => TaskController::class,
]);

// Route::resource('/activities', ActivityController::class)->names([
//     'index' => 'activities.all',
//     'show' => 'activities.view'
// ]);

Route::resource('/activities', ActivityController::class)->parameters([
    'activities' => 'active'
]);

Route::resource('/contact.note', ContactNoteController::class)->shallow();

Route::fallback(function () {
    return "
        <html>
            <head>
                <style>
                    body {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        height: 100vh;
                        margin: 0;
                    }
                    div {
                        text-align: center;
                    }
                </style>
            </head>
            <body>
                <div>
                    <h1>Sorry, the page doesn't exist!</h1>
                </div>
            </body>
        </html>
    ";
});

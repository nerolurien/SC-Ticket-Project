<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DemoBladeController;
use App\Http\Controllers\XSSLabController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SecurityTestController;

// Comments routes
Route::post('/tickets/{ticket}/comments', [CommentController::class, 'store'])
    ->name('comments.store')
    ->middleware('auth');

Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
    ->name('comments.destroy')
    ->middleware('auth');

// Security Testing routes (hanya untuk development!)
Route::prefix('security-testing')->name('security-testing.')->group(function () {
    Route::get('/', [SecurityTestController::class, 'index'])->name('index');
    Route::get('/xss', [SecurityTestController::class, 'xssTest'])->name('xss');
    Route::get('/csrf', [SecurityTestController::class, 'csrfTest'])->name('csrf');
    Route::post('/csrf', [SecurityTestController::class, 'csrfTestPost'])->name('csrf.post');
    Route::get('/headers', [SecurityTestController::class, 'headersTest'])->name('headers');
});
// Demo Blade Templating
Route::prefix('demo-blade')->name('demo-blade.')->group(function () {
    Route::get('/', [DemoBladeController::class, 'index'])->name('index');
    Route::get('/directives', [DemoBladeController::class, 'directives'])->name('directives');
    Route::get('/components', [DemoBladeController::class, 'components'])->name('components');
    Route::get('/includes', [DemoBladeController::class, 'includes'])->name('includes');
    Route::get('/stacks', [DemoBladeController::class, 'stacks'])->name('stacks');
});

// XSS Lab
Route::prefix('xss-lab')->name('xss-lab.')->group(function () {
    Route::get('/', [XSSLabController::class, 'index'])->name('index');
    Route::post('/reset-comments', [XSSLabController::class, 'resetComments'])->name('reset-comments');
    
    // Reflected XSS
    Route::get('/reflected/vulnerable', [XSSLabController::class, 'reflectedVulnerable'])->name('reflected.vulnerable');
    Route::get('/reflected/secure', [XSSLabController::class, 'reflectedSecure'])->name('reflected.secure');
    
    // Stored XSS
    Route::get('/stored/vulnerable', [XSSLabController::class, 'storedVulnerable'])->name('stored.vulnerable');
    Route::post('/stored/vulnerable', [XSSLabController::class, 'storedVulnerableStore'])->name('stored.vulnerable.store');
    Route::get('/stored/secure', [XSSLabController::class, 'storedSecure'])->name('stored.secure');
    Route::post('/stored/secure', [XSSLabController::class, 'storedSecureStore'])->name('stored.secure.store');
    
    // DOM-Based XSS
    Route::get('/dom/vulnerable', [XSSLabController::class, 'domVulnerable'])->name('dom.vulnerable');
    Route::get('/dom/secure', [XSSLabController::class, 'domSecure'])->name('dom.secure');
});

Route::get("/", [UserController::class, 'signIn'])->name('login');
Route::post("/login", [UserController::class, 'login']);
Route::post("/logout", [UserController::class, 'logout'])->name('logout');

Route::resource('tickets', TicketController::class);

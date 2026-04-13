<?php

use App\Livewire\CartPage;
use App\Livewire\CheckoutPage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RevisorController;
use App\Http\Controllers\AnnouncementController;             
use App\Http\Controllers\NewsletterController;


Route::get('/', [PublicController::class, 'index'])->name('index');

Route::get('/{locale}', [PublicController::class, 'index'])->where('locale', 'en|es')->name('index.localized'); //404.blade.php

Route::get('/create', [AnnouncementController::class, 'create'])->name('create')->middleware('auth');

Route::get('/show/{announcement}', [AnnouncementController::class, 'show'])->name('show');

Route::get('/category/{category}', [AnnouncementController::class, 'category'])->name('category_show');

Route::get('/revisor/index', [RevisorController::class, 'index'])->name('revisor.index')->middleware('is_revisor');

Route::patch('/accept/{announcement}', [RevisorController::class, 'accept'])->name('accept');

Route::patch('/reject/{announcement}', [RevisorController::class, 'reject'])->name('reject');

Route::get('/revisor/request', [RevisorController::class, 'becomeRevisor'])->middleware('auth')->name('become.revisor');

Route::get('/make/revisor/{user}', [RevisorController::class, 'makeRevisor'])->name('make.revisor');

Route::patch('/revisor/undo/{announcement}', [RevisorController::class, 'undo'])->name('revisor.undo');

Route::get('/about', [AboutController::class, 'index'])->name('about.us');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.us')->middleware('auth');

Route::post('/lingua/{lang}', [PublicController::class, 'setLanguage'])->name('setLocale');

Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/carrello', CartPage::class)->name('cart.index')->middleware('auth');

Route::get('/checkout', CheckoutPage::class)->name('checkout')->middleware('auth');

Route::get('/i-miei-ordini', [App\Http\Controllers\PublicController::class, 'orders'])->name('user.orders')->middleware('auth');

Route::post('stripe', [StripeController::class, "store"])->name('stripe.payment');

// Rotta per visualizzare la pagina di modifica (GET)
Route::get('/announcements/{announcement}/edit', [AnnouncementController::class, 'edit'])->name('announcements.edit')->middleware('auth');

// Rotta per eliminare l'annuncio (DELETE)
Route::delete('/announcements/{announcement}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy')->middleware('auth');

//Rotta Newsletter
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

//Rotta Domande Frequenti (FAQ)
Route::get('/faq', function () {return view('faq.index'); })->name('faq');
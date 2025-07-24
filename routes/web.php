<?php

use App\Http\Controllers\AIController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\loginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PreferenceController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\WaitingListController;

Route::get('/', function () {
    return redirect('/searchPage');
});

Route::get('/rmdetailpopup', [UserController::class, 'index']);

Route::get('/payment', function () {
    return view('payment');
});

Route::get('/register', [RegisterController::class, 'index'])->name('register'); 
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [loginController::class, 'index'])->name('login');
Route::post('/login', [loginController::class, 'login'])->name('doLogin');
Route::post('/logout', [loginController::class, 'logout'])->name('logout');

Route::get('/profile/history', function () {
    return view('history');
})->name('profile.history');

Route::get('/profile', [profileController::class, 'index'])->name('profile');
Route::post('/user/{id}', [profileController::class, 'update'])->name('user.update');
Route::get('/profile-content', [profileController::class, 'loadProfileContent'])->name('profile.content');
Route::get('/preference-content', [PreferenceController::class, 'loadPreferenceContent'])->name('preference.content');
Route::get('/history-content', [HistoryController::class, 'loadHistoryContent'])->name('history.content');
Route::get('/preference', [PreferenceController::class, 'index'])->name('preference');


Route::get('/ajax/search-location', [MapController::class, 'ajaxSearch']);
Route::get('/ajax/search-nearby', [MapController::class, 'searchNearby']);

Route::get('/questionnaire/{id}', [QuestionController::class, 'show'])->name('questionnaire.show');
Route::post('/questionnaire/next', [QuestionController::class, 'next'])->name('questionnaire.next');
Route::post('/questionnaire/submit', [QuestionController::class, 'submit'])->name('questionnaire.submit');
Route::get('/searchPage', [SearchController::class, 'index'])->name('searchPage');
Route::post('/ajax/store-home-details', [SearchController::class, 'storeHomeDetails']);
Route::post('/ajax/store-home-details-click', [SearchController::class, 'storeHomeDetailsClick']);
Route::get('/check-waiting-list/{fsq_id}', [SearchController::class, 'checkWaitingList']);
Route::get('/homestay/detail', [WaitingListController::class, 'popup']);
Route::get('/homestay/newbuddies/{fsq_id}', [WaitingListController::class, 'popupNew']);
Route::post('/buddies/join', [WaitingListController::class, 'joinBuddies'])->name('buddies.join');
Route::post('/payment/confirm', [PaymentController::class, 'confirm'])->name('payment.confirm');
Route::post('/pay/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
Route::get('/pay/detail/{id}', [PaymentController::class, 'show'])->name('payment.detail');

Route::get('/api/match-score', [AIController::class, 'matchScore']);
Route::middleware('auth')->group(function () {
    Route::get('/profile', [profileController::class, 'index'])->name('profile');
    
});

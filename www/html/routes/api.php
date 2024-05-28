<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriptionController;
use App\Http\Middleware\IPCheckMiddleware;
use App\Models\Subscription;

Route::post('/subscription', [SubscriptionController::class, 'store'])
                ->middleware(IPCheckMiddleware::class)
                ->name('subscription');

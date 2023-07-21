<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Index\IndexController;

Route::middleware(['lang'])->group(function () {
    Route::get('/', [IndexController::class, "Index"]);
});

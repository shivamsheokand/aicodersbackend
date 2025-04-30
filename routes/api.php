<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ContactAttachmentController;
use App\Http\Controllers\Api\ContactCategoryController;

// Health Check endpoint
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toIso8601String(),
        'environment' => config('app.env'),
    ]);
});

Route::middleware('api')->group(function () {
    Route::get('contacts/purpose-options', [ContactController::class, 'purposeOptions']);
    Route::get('contacts/stats', [ContactController::class, 'stats']);
    Route::apiResource('contacts', ContactController::class);
    
    // Attachment routes
    Route::post('contacts/{contact}/attachments', [ContactAttachmentController::class, 'store']);
    Route::delete('contacts/{contact}/attachments/{attachment}', [ContactAttachmentController::class, 'destroy']);
    Route::get('contacts/{contact}/attachments/{attachment}/download', [ContactAttachmentController::class, 'download']);

    // Category routes
    Route::apiResource('categories', ContactCategoryController::class);
    Route::post('categories/{category}/contacts', [ContactCategoryController::class, 'attachContact']);
    Route::delete('categories/{category}/contacts', [ContactCategoryController::class, 'detachContact']);
});
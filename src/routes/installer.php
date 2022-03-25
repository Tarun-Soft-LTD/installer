<?php

use Illuminate\Support\Facades\Route;
use Nirapodsoft\Installer\Http\Controllers\InstallController;

Route::prefix('installation')->middleware(['web','install'])->group(function(){
    Route::get('/',[InstallController::class,'index'])->name('installation');
    Route::get('permissions',[InstallController::class,'permission'])->name('permissions');
    Route::get('purchase-code',[InstallController::class,'purchaseCode'])->name('purchase.code');
    Route::post('purchase-code',[InstallController::class,'purchaseCodeRedirect'])->name('purchase.code.redirect');
    Route::get('database',[InstallController::class,'database'])->name('database');
    Route::post('database-installation',[InstallController::class,'databaseInstallation'])->name('database.installation');
    Route::get('administrator-setup',[InstallController::class,'administratorSetup'])->name('administrator.setup');
    Route::post('administrator-setup',[InstallController::class,'administratorSetupUser'])->name('administrator.setup.user');
});
Route::get('installation/success',[InstallController::class,'installationSuccess'])->name('installation.success');
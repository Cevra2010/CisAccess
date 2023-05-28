<?php
use Illuminate\Support\Facades\Route;

Route::post('/CisAccess/Routing/StoreRoleAreaAttachment',[\Cis\CisAccess\Http\Controllers\RoleController::class,'storeRoleAreaAttachments'])->name("cis-access::storeRoleAreaAttachment");
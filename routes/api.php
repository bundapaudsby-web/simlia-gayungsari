<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ApiDataController;

// Public Endpoints
Route::get('/public/programs', [ApiDataController::class, 'getPublicPrograms']);
Route::get('/public/news', [ApiDataController::class, 'getPublicNews']);
Route::get('/public/achievements', [ApiDataController::class, 'getPublicAchievements']);
Route::get('/public/settings', [ApiDataController::class, 'getPublicSettings']);
Route::post('/public/leads', [ApiDataController::class, 'submitLead']);

// Portal Siswa & Orang Tua Endpoint
Route::get('/portal/student-profile', [ApiDataController::class, 'getStudentProfile']);

// Auth Endpoints
Route::post('/auth/login', [AuthController::class, 'login']);

// Resource Endpoints
Route::get('/academic/students', [ApiDataController::class, 'getStudents']);
Route::get('/academic/classes', [ApiDataController::class, 'getClasses']);
Route::get('/crm/leads', [ApiDataController::class, 'getLeads']);
Route::get('/hr/employees', [ApiDataController::class, 'getEmployees']);
Route::get('/finance/invoices', [ApiDataController::class, 'getInvoices']);
Route::get('/finance/payments', [ApiDataController::class, 'getPayments']);
Route::get('/finance/expenses', [ApiDataController::class, 'getExpenses']);
Route::get('/finance/accounts', [ApiDataController::class, 'getAccounts']);
Route::get('/finance/journals', [ApiDataController::class, 'getJournals']);
Route::get('/documents/letters', [ApiDataController::class, 'getLetters']);
Route::get('/documents/announcements', [ApiDataController::class, 'getAnnouncements']);
Route::get('/crm/placements', [ApiDataController::class, 'getPlacements']);
Route::get('/academic/materials', [ApiDataController::class, 'getMaterials']);
Route::get('/academic/assignments', [ApiDataController::class, 'getAssignments']);
Route::get('/academic/attendance', [ApiDataController::class, 'getAttendance']);
Route::get('/academic/facilities', [ApiDataController::class, 'getFacilities']);
Route::get('/academic/periods', [ApiDataController::class, 'getPeriods']);
Route::get('/settings', [ApiDataController::class, 'getPublicSettings']);
Route::get('/settings/users', [ApiDataController::class, 'getUsers']);

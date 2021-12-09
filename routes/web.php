<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(
    ['middleware' => ['auth', 'verified']],
    function () {
        Route::resource('/', 'TopController');
        Route::resource('/user', 'UserController');
        Route::resource('/prefecture', 'PrefectureController');
        Route::resource('/company', 'CompanyController');
        Route::resource('/audit-level', 'AuditLevelController');
        Route::resource('/project', 'ProjectController');
        Route::put('/proposal/{proposal}/request-meeting', 'ProposalController@requestMeeting')->name('proposal.request-meeting');
        Route::resource('/proposal', 'ProposalController');
        Route::resource('/stage', 'StageController');
        Route::resource('/method', 'MethodController');
        Route::resource('/audit-item', 'AuditItemController');
        Route::resource('/user-audit', 'UserAuditController');
        Route::resource('/audit-item-answer', 'AuditItemAnswerController');
        Route::get('/project-file/{projectFile}/download', 'ProjectFileController@download')->name('project-file.download');
        Route::resource('/project-file', 'ProjectFileController');
        Route::get('/proposal-file/{proposalFile}/download', 'ProposalFileController@download')->name('proposal-file.download');
        Route::resource('/proposal-file', 'ProposalFileController');
        Route::resource('/project-stage', 'ProjectStageController');
        Route::resource('/project-method', 'ProjectMethodController');
        Route::resource('/notification', 'NotificationController');
    }
);

require __DIR__ . '/auth.php';

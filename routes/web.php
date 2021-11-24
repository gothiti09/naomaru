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
        Route::resource('/onboarding', 'OnboardingController');
        Route::put('/onboarding-non-resident-parent/{user}/resend', 'OnboardingNonResidentParentController@resend')->name('onboarding-non-resident-parent.resend');
        Route::post('/onboarding-non-resident-parent/wait', 'OnboardingNonResidentParentController@wait');
        Route::get('/onboarding-non-resident-parent/download', 'OnboardingNonResidentParentController@download');
        Route::resource('/onboarding-non-resident-parent', 'OnboardingNonResidentParentController')->parameters(['onboarding-non-resident-parent' => 'user']);
        Route::resource('/condition', 'ConditionController');
        Route::resource('/family', 'FamilyController');
        Route::resource('/message', 'MessageController');
        Route::resource('/setting-visitation', 'SettingVisitationController');
        Route::resource('/setting-resident-parent', 'SettingResidentParentController')->parameters(['setting-resident-parent' => 'user']);
        Route::resource('/setting-resident-agent', 'SettingResidentAgentController')->parameters(['setting-resident-agent' => 'user']);
        Route::resource('/setting-non-resident-parent', 'SettingNonResidentParentController')->parameters(['setting-non-resident-parent' => 'user']);
        // Route::resource('/setting-non-resident-agent', 'SettingNonResidentAgentController')->parameters(['setting-non-resident-agent' => 'user']);
        // Route::resource('/setting-child', 'SettingChildController')->parameters(['setting-child' => 'user']);
        Route::resource('/user', 'UserController');
        Route::put('/visitation/{visitation}/fix-schedule', 'VisitationController@fixSchedule')->name('visitation.fix-schedule');
        Route::put('/visitation/{visitation}/', 'VisitationController@cancel')->name('visitation.cancel');
        Route::put('/visitation/{visitation}/cancel', 'VisitationController@cancel')->name('visitation.cancel');
        Route::put('/visitation/{visitation}/start', 'VisitationController@start')->name('visitation.start');
        Route::put('/visitation/{visitation}/end', 'VisitationController@end')->name('visitation.end');
        Route::put('/visitation/{visitation}/report', 'VisitationController@report')->name('visitation.report');
        Route::resource('/visitation', 'VisitationController');
    }
);

require __DIR__ . '/auth.php';

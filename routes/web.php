<?php

use Illuminate\Support\Facades\Route;

Auth::routes();



Route::group(['middleware' => 'guest'], function() {
    Route::get('/', function () {
        return view('auth.login');
    });
});

Route::group( ['prefix' => LaravelLocalization::setLocale(),
            'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']], function(){ 
   

    Route::resource('grades', 'Grades\GradeController');

    Route::resource('classrooms', 'Classrooms\ClassroomController');
    Route::post('delete_all', 'Classrooms\ClassroomController@delete_all')->name('delete_all');
    Route::post('filter_classes', 'Classrooms\ClassroomController@filter_classes')->name('filter_classes');

    Route::resource('sections', 'Sections\SectionController');

    Route::resource('teachers', 'Teachers\TeacherController');

    
    Route::get('classes/{id}', 'Sections\SectionController@get_classes')->name('get.classes');
    
    
    Route::resource('students', 'Students\StudentController');
    Route::get('student/{id}', 'Students\StudentController@graduate_student')->name('student.graduate');
    Route::get('get-classes/{id}', 'Students\StudentController@get_classes');
    Route::get('get-sections/{id}', 'Students\StudentController@get_sections');
    Route::post('upload_attachments', 'Students\StudentController@upload_attachments')->name('upload.attachments');
    Route::get('download_attachment/{stdentName}/{fileName}', 'Students\StudentController@download_attachment')->name('download.attachment');
    Route::get('show_attachment/{stdentName}/{fileName}', 'Students\StudentController@show_attachment')->name('show.attachment');
    Route::post('delete_attachment', 'Students\StudentController@delete_attachment')->name('delete_attachment');

    Route::resource('promotions', 'Students\PromotionController');
    Route::post('promotion/{id}', 'Students\PromotionController@graduate_students')->name('graduate.students');
    Route::resource('graduates', 'Students\GraduateController');

    Route::resource('fees', 'Students\FeesController');
    Route::resource('fees_invoices', 'Students\FeesInvoicesController');
    Route::get('fees_amount/{fee_id}', 'Students\FeesInvoicesController@fees_amount')->name('fees.amount');

    Route::resource('processing_fees', 'Students\ProcessingFeeController');

    Route::resource('receipt_students', 'Students\ReceiptStudentController');

    Route::resource('payments', 'Students\PaymentController');



    //livewire routes
    Route::view('add_parent', 'livewire.show_form');


    Route::get('/dashboard', 'HomeController@index')->name('home');
});



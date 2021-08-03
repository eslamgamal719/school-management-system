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


    //livewire routes
    Route::view('add_parent', 'livewire.show_form');


    Route::get('/dashboard', 'HomeController@index')->name('home');
});



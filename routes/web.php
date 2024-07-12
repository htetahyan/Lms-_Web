<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\YearController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\admin\ExamController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\EntranceTestController;
use App\Http\Controllers\admin\CommunityController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\parent\UserParentController;
use App\Http\Controllers\admin\parent\ParentController;
use App\Http\Controllers\admin\student\GradeController;
use App\Http\Controllers\admin\student\StudentController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['admin_auth','cors'])->group(function(){ //admin middleware
    Route::get('/',[GuestController::class,'guestPage'])->name('welcome');
    Route::get('loginPage',[GuestController::class,'loginPage'])->name('loginPage' );
    Route::get('registerPage',[GuestController::class,'registerPage'])->name('registerPage');
    Route::get('posts',[GuestController::class,'showPosts'])->name('posts');
    Route::get('posts/details/{id}',[GuestController::class,'postDetails'])->name('postDetails');
    Route::get('add/viewCount',[GuestController::class,'increaseViewCount'])->name('vc');

});
Route::middleware(['auth','cors'])->group(function () { //overall middleware

    Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');

        Route::middleware(['admin_auth'])->group(function(){

            Route::prefix('admin')->group(function(){
                Route::get('dashboard',[DashboardController::class,'adminDashboard'])->name('admin#dashboard');
                Route::get('dashboard/statitics',[DashboardController::class,'dashboardStatistics']);
                Route::post('comment',[CommunityController::class,'comment'])->name('admin#comment');
                Route::get('deletecomment/{id}',[CommunityController::class,'deleteComment'])->name('admin#deleteComment');
                Route::post('add/grade',[AdminController::class,'addGrade'])->name('admin#addGrade');   //add grades to students


                Route::prefix('manage')->group(function(){
                    Route::get('list',[AdminController::class,'adminList'])->name('admin#list');
                    Route::get('add/page',[AdminController::class,'addAdminPage'])->name('admin#addAdminPage');
                    Route::post('add',[AdminController::class,'addAdmin'])->name('admin#addAdmin');
                });

                Route::prefix('post')->group(function(){
                    Route::get('posts',[AdminController::class,'showPosts'])->name('admin#posts'); //post list
                    Route::get('add',[AdminController::class,'addPostPage'])->name('admin#addPostPage'); //add post page
                    Route::post('addPost',[AdminController::class,'addPost'])->name('admin#addPost');//add post function
                    Route::get('edit/{id}',[AdminController::class,'editPost'])->name('admin#editPost'); //edit post function
                    Route::get('detail/{id}',[AdminController::class,'postDetail'])->name('admin#postDetail'); //post details
                    Route::get('delete/{id}',[AdminController::class,'deletePost'])->name('admin#deletePost'); //delete posts
                    Route::post('updatePost',[AdminController::class,'updatePost'])->name('admin#updatePost'); //update posts
                });
                // student routes
                Route::prefix('student')->group(function(){
                    Route::get('students-list',[StudentController::class,'studentsList'])->name('admin#studentslist'); //students list
                    Route::get('add',[StudentController::class,'addStudentPage'])->name('admin#addStudentPage'); //add new students page
                    Route::post('add',[StudentController::class,'addStudent'])->name('admin#addStudent');//add a new student
                    Route::get('edit/{id}',[StudentController::class,'editStudent'])->name('admin#editStudent');//edit student
                    Route::post('update',[StudentController::class,'updateStudent'])->name('admin#updateStudent'); //update student
                    Route::get('delete/{id}',[StudentController::class,'deleteStudent'])->name('admin#deleteStudent');
                    Route::get('details/{id}',[StudentController::class,'studentDetails'])->name('admin#studentDetails'); //student details
                    Route::get('grade',[GradeController::class,'grade'])->name('admin#grade'); //grade
                    Route::post('grade/add',[GradeController::class,'addGrade'])->name('admin#addgrade'); //add grade
                    Route::get('grade/remove/{id}',[GradeController::class,'removeGrade'])->name('admin#gradeRemove'); //remove grades

                    Route::prefix('years')->controller(YearController::class)->group(function(){
                        Route::get('list','list')->name('admin#yearsList');
                        Route::post('add','add')->name('admin#addYear');
                        Route::get('delete/{id}','delete')->name('admin#removeYear');
                        Route::post('update','update')->name('admin#updateYear');
                    });

                    // exam results
                    Route::get('exam-result/{id}',[ExamController::class,'storeResultPage'])->name('admin#storeExamResultPage');
                    Route::post('exam-result/store',[ExamController::class,'storeExamResult'])->name('admin#storeExamResult');
                    Route::get('exam-result/delete/{id}',[ExamController::class,'deleteExamResult'])->name('admin#deleteExamResult');
                    Route::get('exam-result/edit/{id}',[ExamController::class,'editExamResult'])->name('admin#editExamResult');
                    Route::post('exam-result/update',[ExamController::class,'updateExamResult'])->name('admin#updateExamResult');
                });

                Route::prefix('parent')->group(function(){
                    Route::get('list',[ParentController::class,'parentsList'])->name('admin#parentsList'); //parent list
                    Route::get('add',[ParentController::class,'addParentPage'])->name('admin#addParentPage'); //add parent page
                    Route::post('add',[ParentController::class,'addParent'])->name('admin#addParent');//add parent
                    Route::get('edit/{id}',[ParentController::class,'editParent'])->name('admin#editParent');//edit parent
                    Route::post('update',[ParentController::class,'updateParent'])->name('admin#updateParent'); //update parent
                    Route::get('delete/{id}',[ParentController::class,'deleteParent'])->name('admin#deleteParent'); //delete parrent account
                    Route::get('details/{id}',[ParentController::class,'parentDetails'])->name('admin#parentDetails'); //parent details
                    Route::get('{id}/{role}/status',[ParentController::class,'activeStatus'])->name('admin#activeparents'); //active parents this is an ajax function
                    Route::get('blank/parents',[ParentController::class,'parentsWithoutStudent'])->name('admin#noStudentParents'); //parents whose stdents has not been added yet
                });


            Route::prefix('entrance-tests')->controller(EntranceTestController::class)->group(function(){
                    Route::get('list','list')->name('entrance-tests.list');
                    Route::get('add','add')->name('entrance-tests.add');
                    Route::post('create','create')->name('entrance-tests.create');

                    Route::prefix('questions')->group(function(){
                        Route::get('add/{id}','addQuestion')->name('questions.add');
                        Route::get('list/{id}','questionList')->name('questions.list');
                        Route::post('create','createQuestion')->name('question.create');
                    });

                });
            });
        });
        Route::middleware(['parent_auth'])->group(function(){
            Route::prefix('parent')->group(function(){
                Route::get('home',[UserParentController::class,'home'])->name('parent#home');
                Route::get('students',[UserParentController::class,'showStudent'])->name('parent#showStudent');
                Route::get('posts',[UserParentController::class,'showPosts'])->name('parent#showPosts');
                Route::post('student/details',[UserParentController::class,'showStudentDetails'])->name('parent#studentDetails');
                Route::get('entrance/exams',[UserParentController::class,'exams'])->name('exams');
                Route::get('exam/start/{id}',[UserParentController::class,'startExam'])->name('exam.start');
                Route::post('exam/submit',[UserParentController::class,'submit'])->name('exam.submit');
                Route::get('test/result/{referenceNumber}',[UserParentController::class,'result'])->name('test.result');
            });
        });
});







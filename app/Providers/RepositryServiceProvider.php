<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            'App\Interface\Teacher\TeacherRepositoryInterface',
            'App\Repositry\Teacher\TeacherRepository',

        );

         $this->app->bind(

             'App\Interface\Student\StudentRepositoryinterface',
            'App\Repositry\Student\StudentRepository',
         );
        $this->app->bind(

            'App\Interface\Student\StudentPromoted\StudentPromotionRepositoryinterface',
            'App\Repositry\Student\StudentPromoted\StudentPromotionRepository',
        );
        $this->app->bind(

            'App\Interface\Student\StudentGraduted\StudentGraduatedRepositoryInterface',
            'App\Repositry\Student\StudentGraduted\StudentGraduatedRepository',
        );
        $this->app->bind(
            'App\Interface\Fees\FeesRepositoryInterface',
            'App\Repositry\Fees\FeesRepository',


        );
        $this->app->bind(
            'App\Interface\feesinvoices\invoice\FeesInviocesRepositoryInterface',
            'App\Repositry\feesinvoices\invoice\FeesInviocesRepository',


        );
        $this->app->bind(
            'App\Interface\feesinvoices\processing\ProcessingFeeRepositoryInterface',
            'App\Repositry\feesinvoices\processing\ProcessingFeeRepository',


        );
        $this->app->bind(
            'App\Interface\feesinvoices\Payment\PaymentRepositoryInterface',
            'App\Repositry\feesinvoices\Payment\PaymentRepository',


        );
        $this->app->bind(
            'App\Interface\funds\RecieptRepositoryInterface',
            'App\Repositry\funds\RecieptRepository',



        );
        $this->app->bind(
             'App\Interface\Attendance\AttendanceRepositoryInterface',
             'App\Repositry\Attendance\AttendanceRepository',


        );
        $this->app->bind(
             'App\Interface\Subjects\SubjectsRepositoryInterface',
            'App\Repositry\Subjects\SubjectsRepository',


        );
        $this->app->bind(
            'App\Interface\Exams\ExamsRepositoryInterface',
            'App\Repositry\Exams\ExamsRepository',


        );
        $this->app->bind(
            'App\Interface\Quizz\QuizesRepositoryInterface',
            'App\Repositry\Quizz\QuizesRepository',


        );
        $this->app->bind(
            'App\Interface\questions\QuestionRepositoryInterface',
            'App\Repositry\questions\QuestionRepository',


        );
        $this->app->bind(
             'App\Interface\Library\LibraryRepositoryInterface',
             'App\Repositry\Library\LibraryRepository',

        );
        $this->app->bind(
             'App\Interface\Teacher\TeacherDashboard\QuizzeDashboardRepositryInterface',
             'App\Repositry\Teacher\TeacherDashboard\QuizzeDashboardRepositry',


        );
        $this->app->bind(
             'App\Interface\Teacher\TeacherDashboard\QuestionDashboardRepositryInterface',
             'App\Repositry\Teacher\TeacherDashboard\QuestionDashboardRepositry',


        );
        $this->app->bind(
             'App\Interface\Student\Exams\ExamsRepositoryInterface',
             'App\Repositry\Student\Exams\ExamsRepository',



        );

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

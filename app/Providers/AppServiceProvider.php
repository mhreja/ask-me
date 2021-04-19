<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\Question;
use App\Models\Answer;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('frontend.inc.rightpanel', function($view){
            //Stats
            $count['subject'] = Subject::count();
            $count['topic'] = Topic::count();
            $count['question'] = Question::where('is_approved', 1)->count();
            $count['answer'] = Answer::where('is_approved', 1)->count();

            //Highest Points
            $topRankers = User::where('is_admin', 0)->whereNotNull('points')->orderBy('points', 'desc')->take(5)->get();

            //Recent Questions
            $recentQuestions = Question::where('is_approved', 1)->latest()->take(5)->get();

            $view->with(['count'=>$count, 'toprankers'=>$topRankers, 'recentQuestions'=>$recentQuestions]);
        });
    }
}
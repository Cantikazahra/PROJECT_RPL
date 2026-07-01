<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Faq;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('layouts.sidebar', function ($view) {
            $view->with('allFaqs', Faq::all());
        });
    }
}

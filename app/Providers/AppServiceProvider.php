<?php

namespace App\Providers;

//Models
use App\User;
use App\Models\Sponsor;
use App\Models\Poll\Poll;
use App\Models\Course\Course;
use App\Models\Course\Workshop;
use App\Models\Category\Category;
use App\Models\Variables\Language;
use Caffeinated\Shinobi\Models\Role;
use App\Models\Variables\TypeDocument;
use Caffeinated\Shinobi\Models\Permission;

//Observers
use App\Observers\UserObserver;
use App\Observers\PollObserver;
use App\Observers\RoleObserver;
use App\Observers\CourseObserver;
use App\Observers\SponsorObserver;
use App\Observers\CategoryObserver;
use App\Observers\LanguageObserver;
use App\Observers\WorkshopObserver;
use App\Observers\PermissionObserver;
use App\Observers\TypeDocumentObserver;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

//PAssport
use Laravel\Passport\Passport;
use Laravel\Passport\Console\KeysCommand;
use Laravel\Passport\Console\ClientCommand;
use Laravel\Passport\Console\InstallCommand;


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
        Schema::defaultStringLength(191);

        //Observer
        User::observe(UserObserver::class);
        Poll::observe(PollObserver::class);
        Role::observe(RoleObserver::class);
        Course::observe(CourseObserver::class);
        Sponsor::observe(SponsorObserver::class);
        Workshop::observe(WorkshopObserver::class);
        Category::observe(CategoryObserver::class);
        Language::observe(LanguageObserver::class);
        Permission::observe(PermissionObserver::class);
        TypeDocument::observe(TypeDocumentObserver::class);

        //Passport
        Passport::routes();
        
        //Command
        $this->commands([
            InstallCommand::class,
            ClientCommand::class,
            KeysCommand::class,
        ]);
    }
}

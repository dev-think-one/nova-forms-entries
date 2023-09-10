<?php

namespace NovaFormEntries\Tests\Fixtures;

use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use NovaFormEntries\Tests\Fixtures\Nova\Resources\FormEntry;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return true;
        });
    }


    protected function dashboards()
    {
        return [
        ];
    }

    protected function resources()
    {
        Nova::resources([
            FormEntry::class,
        ]);
    }
}

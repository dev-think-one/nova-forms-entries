<?php

namespace NovaFormEntries\Tests\Fixtures\Nova\Resources;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

/**
 * @extends Resource<\NovaFormEntries\Tests\Fixtures\Models\User>
 */
class User extends Resource
{
    public static $model = \NovaFormEntries\Tests\Fixtures\Models\User::class;


    public function fields(NovaRequest $request)
    {
        return [
            ID::make(),
        ];
    }
}

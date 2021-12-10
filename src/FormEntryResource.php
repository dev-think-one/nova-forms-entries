<?php

namespace NovaFormEntries;

use FormEntries\Models\FormEntry;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use NovaFormEntries\Metrics\SendingPerContent;
use NovaFormEntries\Metrics\SendingTrend;

trait FormEntryResource
{
    abstract public function senderTypes(): array;

    public function fields(Request $request)
    {
        return [
            ID::make(),

            DateTime::make(__('Sent at'), 'created_at'),

            Text::make(__('Type'))
                ->displayUsing(function ($val, FormEntry $model) {
                    return $model->name;
                }),

            MorphTo::make(__('Sender'), 'sender')->types(
                $this->senderTypes()
            ),

            Text::make(__('IPs'))
                ->displayUsing(function ($val, FormEntry $model) {
                    return implode(', ', $model->requestIps());
                }),
            Text::make(__('User Agent'))
                ->displayUsing(function ($val, FormEntry $model) {
                    return $model->requestUserAgent();
                })->hideFromIndex(),

            Textarea::make(__('Content'), 'content')
                    ->displayUsing(function ($val, FormEntry $model) {
                        return $model->content->stringify();
                    })->hideFromIndex(),
        ];
    }

    public function cards(Request $request)
    {
        return [
            new SendingTrend(),
            new SendingPerContent(),
        ];
    }
}

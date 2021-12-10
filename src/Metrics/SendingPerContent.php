<?php

namespace NovaFormEntries\Metrics;

use FormEntries\Models\FormEntry;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Partition;

class SendingPerContent extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        return $this->count($request, FormEntry::class, 'content_type')
                    ->label(function ($contentType) {
                        $class = \FormEntries\Forms\FormContent::getClassByType($contentType);
                        if ($class) {
                            return (new $class(FormEntry::query()->content($contentType)->first()))->formName();
                        }

                        return '-';
                    });
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'form-entries-per-content-typeasd';
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        return now()->addMinutes(30);
    }
}

<?php

namespace NovaFormEntries\Tests\Fixtures\Nova\Resources;

use Laravel\Nova\Resource;
use NovaFormEntries\FormEntryResource;

/**
 * @extends Resource<\FormEntries\Models\FormEntry>
 */
class FormEntry extends Resource
{

    use FormEntryResource;

    public static $model = \FormEntries\Models\FormEntry::class;

    public function senderTypes(): array
    {
        return [
            User::class,
        ];
    }
}

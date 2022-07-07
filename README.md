# Laravel Nova Forms Entries

![Packagist License](https://img.shields.io/packagist/l/yaroslawww/nova-forms-entries?color=%234dc71f)
[![Packagist Version](https://img.shields.io/packagist/v/yaroslawww/nova-forms-entries)](https://packagist.org/packages/yaroslawww/nova-forms-entries)
[![Total Downloads](https://img.shields.io/packagist/dt/yaroslawww/nova-forms-entries)](https://packagist.org/packages/yaroslawww/nova-forms-entries)
[![Build Status](https://scrutinizer-ci.com/g/yaroslawww/nova-forms-entries/badges/build.png?b=master)](https://scrutinizer-ci.com/g/yaroslawww/nova-forms-entries/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/yaroslawww/nova-forms-entries/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/yaroslawww/nova-forms-entries/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/yaroslawww/nova-forms-entries/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/yaroslawww/nova-forms-entries/?branch=master)

Nova helper to implement laravel-forms-entries package.

| Nova | Package |
|------|------|
| V1   | V1   |
| V4   | V2   |

## Installation

Install the package via composer:

```bash
composer require yaroslawww/nova-forms-entries
```

## Usage

```injectablephp
use App\Nova\Resource;
use App\Nova\Resources\Staff;
use App\Nova\Resources\Contact;
use NovaFormEntries\FormEntryResource;

class FormEntry extends Resource
{
    use FormEntryResource;

    /**
     * The model the resource corresponds to.
     */
    public static $model = \FormEntries\Models\FormEntry::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'created_at',
        'type',
        'id',
    ];

    public function senderTypes(): array
    {
        return [
            Contact::class,
            Staff::class,
        ];
    }
}
```

## Credits

- [![Think Studio](https://yaroslawww.github.io/images/sponsors/packages/logo-think-studio.png)](https://think.studio/)

# Laravel Nova Forms Entries

![Packagist License](https://img.shields.io/packagist/l/think.studio/nova-forms-entries?color=%234dc71f)
[![Packagist Version](https://img.shields.io/packagist/v/think.studio/nova-forms-entries)](https://packagist.org/packages/think.studio/nova-forms-entries)
[![Total Downloads](https://img.shields.io/packagist/dt/think.studio/nova-forms-entries)](https://packagist.org/packages/think.studio/nova-forms-entries)
[![Build Status](https://scrutinizer-ci.com/g/dev-think-one/nova-forms-entries/badges/build.png?b=main)](https://scrutinizer-ci.com/g/dev-think-one/nova-forms-entries/build-status/main)
[![Code Coverage](https://scrutinizer-ci.com/g/dev-think-one/nova-forms-entries/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/dev-think-one/nova-forms-entries/?branch=main)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/dev-think-one/nova-forms-entries/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/dev-think-one/nova-forms-entries/?branch=main)

Nova helper to implement laravel-forms-entries package.

| Nova | Package |
|------|------|
| V1   | V1   |
| V4   | V2   |

## Installation

Install the package via composer:

```shell
composer require think.studio/nova-forms-entries
```

## Usage

```php
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

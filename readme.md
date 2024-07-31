# Cms

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

This is where your description should go. Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

To install and use the package in your laravel project, follow the steps below:

1. In your project's `composer.json` add the following code:

    ```json
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/clarity-tech/cms-base"
        }
    ]
    ```

2. Require the package via Composer:

    ```bash
    composer require clarity-tech/cms
    ```

3. Run the migrations:

    ```bash
    php artisan migrate
    ```

## Configuration

### Publishing

If you wish to publish config, migrations etc.

1. Publish the package configuration:

    ```bash
    php artisan vendor:publish --provider="ClarityTech\Cms\CmsServiceProvider" --tag="cms.config"
    ```

2. Publish the package migrations:

    ```bash
    php artisan vendor:publish --provider="ClarityTech\Cms\CmsServiceProvider" --tag="cms.migrations"
    ```

### Filament Admin Panel

If you wish to use filament admin panel, add the following codes in your project's admin panel provider:

```php
use ClarityTech\Cms\Filament\Admin\Resources\ContentResource;
use ClarityTech\Cms\Filament\Admin\Resources\TaxonomyResource;

// $panel
->resources([
	ContentResource::class,
	TaxonomyResource::class
])
```

### Config file

You can change the `cms.php` file in config directory:

1. `middlewares`: Add middlewares as per your need.
2. `features`: Enable or disable features - API and Filament admin panel.
3. `routes`: Customize route path by modifying prefix.

## Usage

### Basic Usage

#### Creating Content

To create a new piece of content programmatically:

```php
use ClarityTech\Cms\Contracts\CreatesContents;
use ClarityTech\Cms\DataTransferObjects\ContentData;

$data = new ContentData([
    'title' => 'Sample Title',
    'slug' => 'sample-slug',
    'excerpt' => 'Sample Excerpt',
    'content' => 'Sample Content',
    'meta_tags' => ['tag1', 'tag2'],
    'custom_properties' => ['key' => 'value'],
    'order_column' => 1,
    'type' => 'article',
    'layout' => 'single',
    'created_by' => 1,
    'updated_by' => null,
    'deleted_by' => null,
    'published_at' => now(),
]);

app(CreatesContents::class)->create($data);
```

#### Updating Content

```php
use ClarityTech\Cms\Contracts\UpdatesContents;
use ClarityTech\Cms\DataTransferObjects\ContentData;

$data = new ContentData([
    'title' => 'Sample Title Updated',
    'slug' => 'sample-slug-updated',
    'excerpt' => 'Sample Excerpt',
    'content' => 'Sample Content',
    'meta_tags' => ['tag1', 'tag2'],
    'custom_properties' => ['key' => 'value'],
    'order_column' => 1,
    'type' => 'article',
    'layout' => 'single',
    'updated_by' => 1,
    'deleted_by' => null,
    'published_at' => now(),
]);

app(UpdatesContents::class)->update($id, $data);
```

### API Usage

The package provides RESTful API endpoint for getting contents.

1. List all contents

    ```
    GET /api/cms/contents
    ```

2. List specific content

    ```
    GET /api/cms/contents/{slug}
    ```

### Admin Panel Usage

If you have Filament installed, you can access and manage your contents, taxonomies etc through the Filament interface.

Just go to `/admin`.

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

```bash
composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author@email.com instead of using the issue tracker.

## Credits

- [Author Name][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/clarity-tech/cms.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/clarity-tech/cms.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/clarity-tech/cms/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/clarity-tech/cms
[link-downloads]: https://packagist.org/packages/clarity-tech/cms
[link-travis]: https://travis-ci.org/clarity-tech/cms
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/clarity-tech
[link-contributors]: ../../contributors

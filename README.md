<div class="filament-hidden">

![Filament Analytics Core](https://raw.githubusercontent.com/jeffersongoncalves/filament-analytics-core/3.x/art/jeffersongoncalves-filament-analytics-core.png)

</div>

# Filament Analytics Core

[![Buy Me A Coffee](https://img.shields.io/badge/Buy%20Me%20A%20Coffee-support-FFDD00?style=flat-square&logo=buy-me-a-coffee&logoColor=black)](https://buymeacoffee.com/jeffersongoncalves)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jeffersongoncalves/filament-analytics-core.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/filament-analytics-core)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/jeffersongoncalves/filament-analytics-core/fix-php-code-style-issues.yml?branch=3.x&label=code%20style&style=flat-square)](https://github.com/jeffersongoncalves/filament-analytics-core/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3A3.x)
[![Total Downloads](https://img.shields.io/packagist/dt/jeffersongoncalves/filament-analytics-core.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/filament-analytics-core)
[![License](https://img.shields.io/packagist/l/jeffersongoncalves/filament-analytics-core.svg?style=flat-square)](LICENSE.md)

Shared base classes for the jeffersongoncalves Filament **analytics-injector** plugins (Fathom, GA4/gtag, GTM, Matomo, Mixpanel, Meta Pixel, Plausible, Umami). Built on top of [`filament-plugin-core`](https://github.com/jeffersongoncalves/filament-plugin-core).

## Version Compatibility

| Branch | Filament | PHP | Laravel |
|--------|----------|-----|---------|
| 1.x | 3.x | ^8.2 | ^11.0 |
| 2.x | 4.x | ^8.2 | ^11.0 |
| 3.x | 5.x | ^8.2 | ^11.0 |

## Requirements

- PHP 8.2 or higher
- Laravel 11.0 or higher
- Filament 5.x (3.x branch)

## Installation

You can install the package via composer:

```bash
composer require jeffersongoncalves/filament-analytics-core:"^3.0"
```

## What it provides

- **`AbstractAnalyticsPlugin`** — registers an optional settings page and exposes the `settingsPage(bool)` toggle. Subclass declares `getId()` and `getSettingsPageClass()`.
- **`AbstractAnalyticsServiceProvider`** — wires `hasTranslations()` and injects the tracking script(s) via render hooks. Subclass declares `packageName()` and `renderHooks()`.

## Usage

### Plugin

```php
use JeffersonGoncalves\FilamentAnalyticsCore\AbstractAnalyticsPlugin;

class FathomPlugin extends AbstractAnalyticsPlugin
{
    public function getId(): string
    {
        return 'filament-fathom';
    }

    protected function getSettingsPageClass(): ?string
    {
        return FathomSettingsPage::class;
    }
}
```

### Service Provider

```php
use Filament\View\PanelsRenderHook;
use JeffersonGoncalves\FilamentAnalyticsCore\AbstractAnalyticsServiceProvider;

class FathomServiceProvider extends AbstractAnalyticsServiceProvider
{
    protected function packageName(): string
    {
        return 'filament-fathom';
    }

    protected function renderHooks(): array
    {
        return [
            PanelsRenderHook::HEAD_START => 'fathom::script',
        ];
    }
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Jefferson Gonçalves](https://github.com/jeffersongoncalves)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

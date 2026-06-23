# Filament Analytics Core

Shared base classes for the jeffersongoncalves Filament **analytics-injector** plugins (Fathom, GA4/gtag, GTM, Matomo, Mixpanel, Meta Pixel, Plausible, Umami). Built on top of [`filament-plugin-core`](https://github.com/jeffersongoncalves/filament-plugin-core).

## Compatibility

| Branch | Filament |
|--------|----------|
| `1.x`  | v3       |
| `2.x`  | v4       |
| `3.x`  | v5       |

## What it provides

- `AbstractAnalyticsPlugin` — registers an optional settings page and exposes the `settingsPage(bool)` toggle. Subclass declares `getId()` and `getSettingsPageClass()`.
- `AbstractAnalyticsServiceProvider` — wires `hasTranslations()` and injects the tracking script(s) via render hooks. Subclass declares `packageName()` and `renderHooks()`.

## Usage

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

## License

The MIT License (MIT). See [LICENSE.md](LICENSE.md).

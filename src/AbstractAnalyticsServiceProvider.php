<?php

namespace JeffersonGoncalves\FilamentAnalyticsCore;

use JeffersonGoncalves\FilamentPluginCore\BasePackageServiceProvider;
use Spatie\LaravelPackageTools\Package;

/**
 * Base service provider for analytics-injector packages.
 *
 * Concrete providers declare their package name and the render hooks
 * that inject their tracking script(s); everything else is shared.
 */
abstract class AbstractAnalyticsServiceProvider extends BasePackageServiceProvider
{
    abstract protected function packageName(): string;

    /**
     * Map of Filament render hook => view name to inject.
     *
     * @return array<string, string>
     */
    abstract protected function renderHooks(): array;

    public function configurePackage(Package $package): void
    {
        $package
            ->name($this->packageName())
            ->hasTranslations();
    }

    public function packageRegistered(): void
    {
        $this->registerRenderHooks($this->renderHooks());
    }
}

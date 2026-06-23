<?php

namespace JeffersonGoncalves\FilamentAnalyticsCore;

use Filament\Panel;
use JeffersonGoncalves\FilamentPluginCore\BasePlugin;

/**
 * Base plugin for analytics-injector packages.
 *
 * Each concrete plugin only declares its id and (optionally) its
 * settings-page class. The shared settings-page toggle and panel
 * registration live here.
 */
abstract class AbstractAnalyticsPlugin extends BasePlugin
{
    protected bool $hasSettingsPage = true;

    /**
     * The settings page class to register, or null when the package
     * ships no settings page.
     *
     * @return class-string|null
     */
    abstract protected function getSettingsPageClass(): ?string;

    public function register(Panel $panel): void
    {
        $page = $this->getSettingsPageClass();

        if ($this->hasSettingsPage && $page !== null) {
            $panel->pages([$page]);
        }
    }

    public function settingsPage(bool $condition = true): static
    {
        $this->hasSettingsPage = $condition;

        return $this;
    }
}

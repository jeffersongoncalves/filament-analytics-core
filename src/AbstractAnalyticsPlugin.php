<?php

namespace JeffersonGoncalves\FilamentAnalyticsCore;

use Closure;
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

    protected string|Closure|null $navigationGroup = null;

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

    /**
     * Put the settings page in one of the panel's own navigation groups
     * (a string or a closure, so it can be translated). Null keeps the
     * group from the plugin's translations.
     */
    public function navigationGroup(string|Closure|null $group): static
    {
        $this->navigationGroup = $group;

        return $this;
    }

    public function getNavigationGroup(): ?string
    {
        $group = $this->navigationGroup instanceof Closure ? ($this->navigationGroup)() : $this->navigationGroup;

        return $group === null ? null : (string) $group;
    }

    /**
     * The group given to the plugin with this id on the current panel, if any.
     * Settings pages call it from getNavigationGroup() and fall back to their translation.
     */
    public static function navigationGroupFor(string $pluginId): ?string
    {
        $panel = filament()->getCurrentPanel();

        if ($panel === null || ! $panel->hasPlugin($pluginId)) {
            return null;
        }

        $plugin = $panel->getPlugin($pluginId);

        return $plugin instanceof self ? $plugin->getNavigationGroup() : null;
    }
}

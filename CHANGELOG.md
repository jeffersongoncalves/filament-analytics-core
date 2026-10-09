# Changelog

All notable changes to `filament-analytics-core` will be documented in this file.

## 3.1.0 - 2026-10-09

New `->navigationGroup(string|Closure)` on every plugin built on `AbstractAnalyticsPlugin`: put its settings page in one of the panel's own navigation groups. Settings pages read it with `AbstractAnalyticsPlugin::navigationGroupFor($pluginId)` and fall back to their translation, so nothing changes until a plugin uses it.

## 3.0.0 - 2026-06-23

Initial release. Filament v5 analytics-injector base: `AbstractAnalyticsPlugin`, `AbstractAnalyticsServiceProvider`.

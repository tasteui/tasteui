<?php

namespace TallStackUi\Foundation\Support\Icons;

use Exception;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use TallStackUi\Foundation\Exceptions\InappropriateIconGuideExecution;

class IconGuideMap
{
    /**
     * The icon configuration.
     */
    protected static Collection $configuration;

    /**
     * Determine if the icon is custom.
     */
    protected static bool $custom = false;

    /**
     * The icon guide.
     */
    protected static IconGuide $guide;

    /** @throws Exception|InappropriateIconGuideExecution */
    public static function build(Component $component, ?string $path = null): string
    {
        self::configuration();

        $type = self::$configuration->get('type');
        $style = self::$configuration->get('style');

        foreach (array_keys($component->attributes->getAttributes()) as $attribute) {
            if (self::$custom || ! in_array($attribute, self::$guide::styles($type))) {
                continue;
            }

            // When some attribute matches one of the keys
            // available in the supported icons, then we want
            // to override the style through run time.
            $style = $attribute;
        }

        $name = $component->icon ?? $component->name; // @phpstan-ignore-line

        if (self::$custom && $component->internal && isset(self::$configuration->get('custom')['guide'][$name])) { // @phpstan-ignore-line
            return self::$configuration->get('custom')['guide'][$name];
        } elseif (self::$custom && str_contains($name, '.')) {
            return str_replace('.', '-', $name);
        }

        $component = sprintf('%s.%s.%s', 'heroicons', $style, $name);

        return $path ? $path.$component : $component;
    }

    /**
     * Determine internal icons using the guide.
     *
     * @throws Exception
     */
    public static function internal(string $key): string
    {
        self::configuration();

        // We start by returning $icon because when we are
        // dealing with custom icons and cannot find the
        // guide for a particular icon, we use the default.
        if (self::$custom) {
            return $key;
        }

        return self::$configuration->get('custom')['guide'][$key] ?? self::$guide::get('hero', $key) ?? $key;
    }

    /**
     * Get the configuration for icons and determine if it is custom.
     *
     * @throws Exception
     */
    private static function configuration(): void
    {
        self::$guide = new IconGuide;

        self::$configuration = collect(config('tallstackui.icons'));

        self::$custom = str_contains((string) self::$configuration->get('type'), '/blade-') && self::$configuration->get('custom') !== null;
    }
}

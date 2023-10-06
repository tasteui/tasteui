<?php

namespace TallStackUi;

class TallStackUiDirectives
{
    public function scripts(bool $absolute = true): string
    {
        $route = route('tallstackui.scripts', absolute: $absolute);
        $this->manifest('tallstackui.js', $route);

        return "<script src=\"$route\" defer></script>";
    }

    public function styles(bool $absolute = true): string
    {
        $route = route('tallstackui.styles', absolute: $absolute);
        $this->manifest('tallstackui.css', $route);

        return "<link href=\"{$route}\" rel=\"stylesheet\" type=\"text/css\">";
    }

    private function manifest(string $file, string &$route): void
    {
        if (! file_exists($path = __DIR__.'/../dist/mix-manifest.json')) {
            return;
        }

        $manifest = json_decode(file_get_contents($path), true);
        $version = last(explode('=', $manifest["/{$file}"]));

        $route .= "?id={$version}";
    }
}

<?php

namespace App\Helpers;

class SidebarHelper
{
    protected static $tabs = [];

    public static function registerTab($moduleName, $label, $route, $icon = null)
    {
        if (! isset(self::$tabs[$route])) {
            self::$tabs[$route] = [
                'module' => $moduleName,
                'label' => $label,
                'route' => $route,
                'icon' => $icon,
            ];
        }
    }

    public static function getTabs()
    {
        return array_values(self::$tabs);
    }
}

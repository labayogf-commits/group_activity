<?php

namespace App\Helpers;

class SidebarHelper
{
    protected static $tabs = [];

    public static function registerTab($moduleName, $label, $route, $icon = null)
    {
        self::$tabs[] = [
            'module' => $moduleName,
            'label' => $label,
            'route' => $route,
            'icon' => $icon,
        ];
    }

    public static function getTabs()
    {
        return self::$tabs;
    }
}

<?php

if (!function_exists('formatDate')) {
    function formatDate($date, $format = PHP_DATE)
    {
        if (empty($date)) {
            return null;
        }

        try {
            $d = new \Carbon\Carbon($date);
            $text = $d->format($format);
        } catch (\Exception $e) {
            $text = $date;
        }
        return $text;
    }
}

if (!function_exists('activeMenu')) {
    function activeMenu($routeActive = null)
    {
        return \Route::is($routeActive) ? 'active' : '';
    }
}

if (!function_exists('showDropdown')) {
    function showDropdown(array $routeActives = [])
    {
        $uri = \Route::currentRouteName();
        $arr = explode(".", $uri, 2);
        $first = $arr[0];
        foreach ($routeActives as $route) {
            if (str_replace('.*', '', $route) == $first) {
                return \Route::is($route) ? 'show' : '';
            }
        }
    }
}

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

if (!function_exists('checkActiveMenu')) {
    function checkActiveMenu($currentRoute, $routeAction = null) {
        return !empty($routeAction) && strcmp($currentRoute, $routeAction) == 0 ? 'active' : '';
    }
}

if (!function_exists('checkShowDropdown')) {
    function checkShowDropdown($currentRoute, $perms = []) {
        return in_array($currentRoute, $perms) ? 'show' : '';
    }
}
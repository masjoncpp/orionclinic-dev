<?php

use App\Constants\Icons;

if (!function_exists('icon')) {
    function icon(string $name, int $size = 24, string $additionalClasses = ''): string
    {
        $svgData = Icons::getSvgData($name);
        if (!$svgData) {
            return '';
        }
        
        return sprintf(
            '<svg class="%s" width="%d" height="%d" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">%s</svg>',
            esc($additionalClasses),
            $size,
            $size,
            $svgData
        );
    }
}

if (!function_exists('iconButton')) {
    function iconButton(string $name, string $ariaLabel, string $additionalClasses = '', int $size = 24): string
    {
        $iconHtml = icon($name, $size);
        return sprintf(
            '<button aria-label="%s" class="%s hover:opacity-80 transition-opacity focus:outline-none focus:ring-2 focus:ring-blue-300 rounded-full">%s</button>',
            esc($ariaLabel),
            esc($additionalClasses),
            $iconHtml
        );
    }
}

if (!function_exists('statusBadge')) {
    function statusBadge(string $status): string
    {
        $status = strtolower($status);
        switch ($status) {
            case 'success':
            case 'completed':
            case 'selesai':
                $colorClass = 'bg-green-100 text-green-800';
                $iconName = 'success';
                break;
            case 'pending':
            case 'menunggu':
                $colorClass = 'bg-yellow-100 text-yellow-800';
                $iconName = 'pending';
                break;
            case 'error':
            case 'cancelled':
            case 'batal':
                $colorClass = 'bg-red-100 text-red-800';
                $iconName = 'error';
                break;
            default:
                $colorClass = 'bg-blue-100 text-blue-800';
                $iconName = 'info';
                break;
        }

        $iconHtml = icon($iconName, 16, 'mr-1.5');
        
        return sprintf(
            '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium %s">%s %s</span>',
            $colorClass,
            $iconHtml,
            ucfirst(esc($status))
        );
    }
}

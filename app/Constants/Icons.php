<?php

namespace App\Constants;

class Icons
{
    public const COLOR_PRIMARY = '#003E7E';
    public const COLOR_ACCENT  = '#1BA098';
    public const COLOR_SUCCESS = '#4CAF50';
    public const COLOR_WARNING = '#FF9800';
    public const COLOR_ERROR   = '#E53935';
    public const COLOR_INFO    = '#2196F3';

    private static array $icons = [
        'dashboard' => '
            <rect x="10" y="10" width="18" height="18" rx="4" fill="#003E7E"/>
            <rect x="36" y="10" width="18" height="18" rx="4" fill="#1BA098"/>
            <rect x="10" y="36" width="18" height="18" rx="4" fill="#2196F3"/>
            <rect x="36" y="36" width="18" height="18" rx="4" fill="#003E7E"/>
            <path d="M12 24 L20 14 L26 24 Z" fill="#ffffff" opacity="0.4"/>
        ',
        'appointments' => '
            <rect x="12" y="14" width="40" height="40" rx="6" fill="#003E7E"/>
            <rect x="12" y="14" width="40" height="14" rx="6" fill="#1BA098"/>
            <path d="M20 8 V18 M44 8 V18" stroke="#FF9800" stroke-width="4" stroke-linecap="round"/>
            <rect x="20" y="36" width="24" height="4" rx="2" fill="#ffffff"/>
            <rect x="20" y="44" width="16" height="4" rx="2" fill="#ffffff"/>
            <circle cx="28" cy="21" r="2" fill="#ffffff"/>
            <circle cx="36" cy="21" r="2" fill="#ffffff"/>
        ',
        'doctor' => '
            <circle cx="32" cy="24" r="12" fill="#FAD0AE"/>
            <path d="M32 12 Q20 12 20 20 L44 20 Q44 12 32 12 Z" fill="#003E7E"/>
            <path d="M16 60 Q16 40 32 40 Q48 40 48 60 Z" fill="#ffffff" stroke="#e0e7ff" stroke-width="2"/>
            <path d="M30 40 L34 40 L34 60 L30 60 Z" fill="#2196F3"/>
            <path d="M28 44 h8 v2 h-8 z" fill="#1BA098"/>
            <path d="M22 46 Q32 60 42 46" fill="none" stroke="#003E7E" stroke-width="2"/>
            <circle cx="42" cy="46" r="2" fill="#1BA098"/>
        ',
        'patient' => '
            <circle cx="32" cy="24" r="12" fill="#FAD0AE"/>
            <path d="M16 60 Q16 40 32 40 Q48 40 48 60 Z" fill="#1BA098"/>
            <path d="M28 40 L36 40 L34 48 L30 48 Z" fill="#FAD0AE"/>
            <path d="M20 60 L24 48 L40 48 L44 60 Z" fill="#003E7E" opacity="0.1"/>
        ',
        'medical_records' => '
            <rect x="16" y="8" width="32" height="48" rx="4" fill="#ffffff" stroke="#003E7E" stroke-width="3"/>
            <rect x="22" y="16" width="10" height="10" fill="#1BA098"/>
            <path d="M27 12 v18 M22 21 h10" stroke="#ffffff" stroke-width="2"/>
            <rect x="22" y="32" width="20" height="3" fill="#003E7E"/>
            <rect x="22" y="38" width="20" height="3" fill="#003E7E"/>
            <rect x="22" y="44" width="14" height="3" fill="#003E7E"/>
            <path d="M36 18 h6 M36 24 h6" stroke="#2196F3" stroke-width="3" stroke-linecap="round"/>
        ',
        'chat' => '
            <path d="M10 20 Q10 10 32 10 Q54 10 54 26 Q54 42 32 42 L20 48 L20 38 Q10 32 10 20 Z" fill="#2196F3"/>
            <path d="M20 28 Q20 18 42 18 Q64 18 64 34 Q64 50 42 50 L30 56 L30 46 Q20 40 20 28 Z" fill="#003E7E"/>
            <circle cx="34" cy="34" r="3" fill="#ffffff"/>
            <circle cx="42" cy="34" r="3" fill="#ffffff"/>
            <circle cx="50" cy="34" r="3" fill="#ffffff"/>
        ',
        'wellness' => '
            <path d="M32 54 C32 54 12 36 12 22 C12 12 26 10 32 20 C38 10 52 12 52 22 C52 36 32 54 32 54 Z" fill="#E53935"/>
            <path d="M24 24 h6 v10 M30 24 v6 h8" stroke="#ffffff" stroke-width="3" fill="none" opacity="0.6"/>
            <circle cx="20" cy="20" r="2" fill="#ffffff" opacity="0.8"/>
            <path d="M20 30 L26 22 L32 34 L38 22 L44 30" fill="none" stroke="#ffffff" stroke-width="2"/>
        ',
        'profile' => '
            <circle cx="32" cy="32" r="28" fill="#e0e7ff"/>
            <circle cx="32" cy="24" r="11" fill="#003E7E"/>
            <path d="M12 52 Q12 36 32 36 Q52 36 52 52 Z" fill="#1BA098"/>
        ',
        'settings' => '
            <circle cx="32" cy="32" r="14" fill="#003E7E"/>
            <circle cx="32" cy="32" r="6" fill="#ffffff"/>
            <path d="M28 8 h8 v6 h-8 z M28 50 h8 v6 h-8 z" fill="#1BA098"/>
            <path d="M8 28 h6 v8 h-6 z M50 28 h6 v8 h-6 z" fill="#1BA098"/>
            <path d="M14 14 l4 4 l6 -6 l-4 -4 z M40 40 l4 4 l6 -6 l-4 -4 z" fill="#FF9800"/>
            <path d="M50 14 l-4 4 l-6 -6 l4 -4 z M24 40 l-4 4 l-6 -6 l4 -4 z" fill="#FF9800"/>
        ',
        'notifications' => '
            <path d="M32 10 C20 10 20 24 20 36 L16 44 H48 L44 36 C44 24 44 10 32 10 Z" fill="#FF9800"/>
            <path d="M26 46 Q32 56 38 46 Z" fill="#E53935"/>
            <circle cx="44" cy="16" r="6" fill="#003E7E"/>
            <path d="M32 10 v-4" stroke="#FF9800" stroke-width="3" stroke-linecap="round"/>
        ',
        'search' => '
            <circle cx="26" cy="26" r="16" fill="#e0e7ff" stroke="#003E7E" stroke-width="4"/>
            <path d="M38 38 L54 54" stroke="#1BA098" stroke-width="6" stroke-linecap="round"/>
            <circle cx="22" cy="22" r="4" fill="#2196F3"/>
        ',
        'success' => '
            <circle cx="32" cy="32" r="28" fill="#4CAF50"/>
            <path d="M20 32 L28 40 L44 24" stroke="#ffffff" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        ',
        'pending' => '
            <circle cx="32" cy="32" r="28" fill="#FF9800"/>
            <path d="M32 18 V32 L40 40" stroke="#ffffff" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        ',
        'error' => '
            <circle cx="32" cy="32" r="28" fill="#E53935"/>
            <path d="M22 22 L42 42 M42 22 L22 42" stroke="#ffffff" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        ',
        'prescription' => '
            <rect x="14" y="24" width="36" height="16" rx="8" fill="#003E7E"/>
            <rect x="14" y="24" width="18" height="16" rx="8" fill="#1BA098"/>
            <circle cx="24" cy="46" r="6" fill="#E53935"/>
            <circle cx="40" cy="46" r="6" fill="#FF9800"/>
            <path d="M20 12 L30 18 L24 24" fill="#2196F3"/>
            <path d="M44 12 L34 18 L40 24" fill="#2196F3"/>
        ',
        'arrow_right' => '
            <circle cx="32" cy="32" r="28" fill="#003E7E"/>
            <path d="M26 16 L42 32 L26 48" stroke="#ffffff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        ',
        'arrow_left' => '
            <circle cx="32" cy="32" r="28" fill="#003E7E"/>
            <path d="M38 16 L22 32 L38 48" stroke="#ffffff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        ',
        'plus' => '
            <circle cx="32" cy="32" r="28" fill="#1BA098"/>
            <path d="M32 16 V48 M16 32 H48" stroke="#ffffff" stroke-width="5" stroke-linecap="round" fill="none"/>
        ',
        'logout' => '
            <path d="M30 14 H16 V50 H30" stroke="#E53935" stroke-width="4" stroke-linecap="round" fill="none"/>
            <path d="M40 22 L50 32 L40 42" stroke="#E53935" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
            <path d="M24 32 H50" stroke="#E53935" stroke-width="4" stroke-linecap="round" fill="none"/>
        ',
        'steps' => '
            <circle cx="32" cy="32" r="28" fill="#FFC107"/>
            <path d="M34 16 L22 36 L32 36 L30 48 L42 28 L32 28 Z" fill="#ffffff"/>
        ',
        'water' => '
            <circle cx="32" cy="32" r="28" fill="#2196F3"/>
            <path d="M32 16 Q20 32 20 40 A12 12 0 0 0 44 40 Q44 32 32 16 Z" fill="#ffffff"/>
            <path d="M36 36 A4 4 0 0 0 32 44" stroke="#e0e7ff" stroke-width="2" stroke-linecap="round" fill="none"/>
        ',
        'sleep' => '
            <circle cx="32" cy="32" r="28" fill="#673AB7"/>
            <path d="M38 18 A14 14 0 1 0 46 44 A18 18 0 0 1 38 18 Z" fill="#FFC107"/>
            <circle cx="20" cy="22" r="2" fill="#ffffff" opacity="0.6"/>
            <circle cx="26" cy="14" r="1.5" fill="#ffffff" opacity="0.4"/>
            <circle cx="44" cy="28" r="1" fill="#ffffff" opacity="0.8"/>
        '
    ];

    public static function getSvgData(string $name): ?string
    {
        return self::$icons[$name] ?? self::$icons['dashboard'];
    }
}

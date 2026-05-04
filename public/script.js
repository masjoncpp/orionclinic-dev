// Default configuration
const defaultConfig = {
    app_title: 'Orion Clinic',
    welcome_text: 'Selamat Datang',
    tagline: 'Kesehatan Keluarga Anda, Prioritas Kami',
    primary_color: '#0066CC',
    accent_color: '#20B2AA',
    text_color: '#1F2937',
    background_color: '#FFFFFF',
    surface_color: '#F9FAFB'
};

let config = { ...defaultConfig };

// Screen navigation
function showScreen(screenId) {
    $('.screen').removeClass('active');
    
    // jQuery: Show target screen
    const $target = $('#' + screenId);
    if ($target.length) {
        $target.addClass('active');
    }

    // Update bottom nav active state if it exists
    if ($('#bottom-nav').length) {
        updateBottomNav(screenId);
    }
    // Update sidebar active state if it exists
    if ($('aside nav button').length) {
        updateSidebar(screenId);
    }
}

function updateBottomNav(screenId) {
    // Reset all nav items
    $('.nav-item').removeClass('active').addClass('text-gray-400');
    
    // Find button that links to this screen and activate it
    $(`.nav-item[onclick*="'${screenId}'"]`).addClass('active').removeClass('text-gray-400');
}

function updateSidebar(screenId) {
     const $sidebarLinks = $('aside nav button');
     $sidebarLinks.each(function() {
         const $btn = $(this);
         const onclick = $btn.attr('onclick');
         if (onclick && onclick.includes(screenId)) {
             $btn.addClass('bg-blue-50 text-blue-600').removeClass('text-gray-600');
         } else {
             $btn.removeClass('bg-blue-50 text-blue-600').addClass('text-gray-600');
         }
     });
}

// Splash screen timeout
if ($('#splash-screen').length) {
    setTimeout(() => {
        showScreen('login-screen');
    }, 2500);
}

// Element SDK Integration
async function onConfigChange(newConfig) {
    config = { ...config, ...newConfig };

    // Update splash screen
    $('#splash-title').text(config.app_title || defaultConfig.app_title);
    $('#splash-tagline').text(config.tagline || defaultConfig.tagline);

    // Update login screen
    $('#login-title').text(config.welcome_text || defaultConfig.welcome_text);
}

function mapToCapabilities(cfg) {
    return {
        recolorables: [
            {
                get: () => cfg.primary_color || defaultConfig.primary_color,
                set: (value) => {
                    cfg.primary_color = value;
                    if (window.elementSdk) window.elementSdk.setConfig({ primary_color: value });
                }
            },
            {
                get: () => cfg.accent_color || defaultConfig.accent_color,
                set: (value) => {
                    cfg.accent_color = value;
                    if (window.elementSdk) window.elementSdk.setConfig({ accent_color: value });
                }
            },
            {
                get: () => cfg.text_color || defaultConfig.text_color,
                set: (value) => {
                    cfg.text_color = value;
                    if (window.elementSdk) window.elementSdk.setConfig({ text_color: value });
                }
            },
            {
                get: () => cfg.background_color || defaultConfig.background_color,
                set: (value) => {
                    cfg.background_color = value;
                    if (window.elementSdk) window.elementSdk.setConfig({ background_color: value });
                }
            },
            {
                get: () => cfg.surface_color || defaultConfig.surface_color,
                set: (value) => {
                    cfg.surface_color = value;
                    if (window.elementSdk) window.elementSdk.setConfig({ surface_color: value });
                }
            }
        ],
        borderables: [],
        fontEditable: undefined,
        fontSizeable: undefined
    };
}

function mapToEditPanelValues(cfg) {
    return new Map([
        ['app_title', cfg.app_title || defaultConfig.app_title],
        ['welcome_text', cfg.welcome_text || defaultConfig.welcome_text],
        ['tagline', cfg.tagline || defaultConfig.tagline]
    ]);
}

// Initialize Element SDK
if (window.elementSdk) {
    window.elementSdk.init({
        defaultConfig,
        onConfigChange,
        mapToCapabilities,
        mapToEditPanelValues
    });
}

// Highlight active nav item based on current URL
$(document).ready(function() {
    var path = window.location.pathname;
    $('.nav-item').each(function() {
        var onclick = $(this).attr('onclick') || '';
        if (onclick && onclick.includes(path)) {
            $(this).addClass('active text-blue-600').removeClass('text-gray-400');
        }
    });
});

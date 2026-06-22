<!doctype html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Orion Clinic' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('style.css') ?>">
</head>
<body class="h-full bg-[#ebe7e1]">
    <div id="app" class="h-full w-full flex overflow-hidden">
        <?php if(!isset($hide_sidebar)): ?>
            <?= $this->include('components/sidebar') ?>
        <?php endif; ?>
        <div class="flex-1 flex flex-col min-h-0 overflow-hidden relative">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="absolute top-4 left-1/2 transform -translate-x-1/2 z-50 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline"><?= session()->getFlashdata('error') ?></span>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('success')): ?>
                <div class="absolute top-4 left-1/2 transform -translate-x-1/2 z-50 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline"><?= session()->getFlashdata('success') ?></span>
                </div>
            <?php endif; ?>
            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <script src="<?= base_url('script.js') ?>"></script>
    <script>
        $(document).ready(function() {
            var currentPath = window.location.pathname.replace(/\/$/, '');
            $('.nav-item').each(function() {
                var onclick = $(this).attr('onclick') || '';
                var match = onclick.match(/href='([^']+)'/);
                if (match) {
                    var targetUrl = match[1].split('?')[0]; // Remove query params
                    // Get path from targetUrl
                    var targetPath = targetUrl.replace(/^(?:\/\/|[^/]+)*\//, '/'); // Get relative path
                    targetPath = targetPath.replace(/\/$/, ''); // Remove trailing slash
                    if (targetPath === currentPath) {
                        $(this).addClass('active').removeClass('text-[#626260]');
                    }
                }
            });
            $('aside nav button').each(function() {
                var onclick = $(this).attr('onclick') || '';
                var match = onclick.match(/href='([^']+)'/);
                if (match) {
                    var targetUrl = match[1].split('?')[0]; // Remove query params
                    // Get path from targetUrl
                    var targetPath = targetUrl.replace(/^(?:\/\/|[^/]+)*\//, '/'); // Get relative path
                    targetPath = targetPath.replace(/\/$/, ''); // Remove trailing slash
                    if (targetPath === currentPath) {
                        $(this).addClass('bg-[#ebe7e1] text-[#111111]').removeClass('text-[#626260]');
                    }
                }
            });
        });
    </script>
</body>
</html>

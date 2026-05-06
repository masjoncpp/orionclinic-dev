<!doctype html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Orion Clinic' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('style.css') ?>">
</head>
<body class="h-full bg-blue-50">
    <div id="app" class="h-full w-full flex overflow-hidden">
        <?php if(!isset($hide_sidebar)): ?>
            <?= $this->include('components/sidebar') ?>
        <?php endif; ?>
        <div class="flex-1 flex flex-col min-h-0 overflow-hidden">
            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="<?= base_url('script.js') ?>"></script>
    <script>
        $(document).ready(function() {
            var currentPath = window.location.pathname.replace(/\/$/, '');
            $('.nav-item').each(function() {
                var onclick = $(this).attr('onclick') || '';
                if (onclick && onclick.includes(currentPath)) {
                    $(this).addClass('active').removeClass('text-gray-400');
                }
            });
            $('aside nav button').each(function() {
                var onclick = $(this).attr('onclick') || '';
                if (onclick && onclick.includes(currentPath)) {
                    $(this).addClass('bg-blue-50 text-blue-600').removeClass('text-gray-600');
                }
            });
        });
    </script>
</body>
</html>

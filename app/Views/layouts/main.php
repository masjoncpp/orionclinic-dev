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
            <!-- Flash data removed in favor of SweetAlert2 JS below -->
            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url('script.js') ?>"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        <?php if (session()->getFlashdata('success')): ?>
        Toast.fire({
            icon: 'success',
            title: <?= json_encode(session()->getFlashdata('success')) ?>
        });
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
        Toast.fire({
            icon: 'error',
            title: <?= json_encode(session()->getFlashdata('error')) ?>
        });
        <?php endif; ?>
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

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
            var csrfName = <?= json_encode(csrf_token()) ?>;
            var csrfHash = <?= json_encode(csrf_hash()) ?>;
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': csrfHash } });
            $('form').each(function() {
                if (($(this).attr('method') || '').toUpperCase() === 'POST' && $(this).find('input[name="' + csrfName + '"]').length === 0) {
                    $(this).prepend($('<input>', { type: 'hidden', name: csrfName, value: csrfHash }));
                }
            });

            var currentPath = window.location.pathname.replace(/\/$/, '');
            var routeAliases = {
                '/patient/historyDetail': '/patient/history',
                '/patient/edit_profile': '/patient/profile',
                '/patient/payment': '/patient/payments',
                '/patient/invoice': '/patient/payments',
                '/doctor/historyDetail': '/doctor/consultation',
                '/doctor/prescription_form': '/doctor/consultation',
                '/doctor/patientHistory': '/doctor/patients'
            };
            var normalizedPath = routeAliases[currentPath] || currentPath;
            if (normalizedPath.indexOf('/admin/patients/detail') === 0) {
                normalizedPath = '/admin/patients';
            } else if (normalizedPath.indexOf('/doctor/patient_profile') === 0) {
                normalizedPath = '/doctor/patients';
            }

            $('.nav-item').each(function() {
                var onclick = $(this).attr('onclick') || '';
                var match = onclick.match(/href='([^']+)'/);
                if (match) {
                    var targetUrl = match[1].split('?')[0];
                    var targetPath = targetUrl.replace(/^(?:\/\/|[^/]+)*\//, '/').replace(/\/$/, '');
                    if (targetPath === normalizedPath) {
                        $(this).addClass('active').removeClass('text-[#626260]');
                    }
                }
            });
            $('aside nav button').each(function() {
                var onclick = $(this).attr('onclick') || '';
                var match = onclick.match(/href='([^']+)'/);
                if (match) {
                    var targetUrl = match[1].split('?')[0];
                    var targetPath = targetUrl.replace(/^(?:\/\/|[^/]+)*\//, '/').replace(/\/$/, '');
                    if (targetPath === normalizedPath) {
                        $(this).addClass('active bg-[#003E7E] text-[#ffffff]').removeClass('text-[#111111] text-[#626260]');
                    }
                }
            });
        });
    </script>
</body>
</html>

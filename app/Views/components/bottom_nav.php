<div id="bottom-nav" class="fixed bottom-0 left-0 right-0 bg-[#ffffff]/95 backdrop-blur-md border-t border-[#d3cec6] px-2 pt-1.5 pb-2.5 flex justify-around items-center md:hidden z-50 shadow-[0_-4px_20px_rgba(0,0,0,0.04)]">
    <?php if(session()->get('role') == 'doctor'): ?>

        <button onclick="window.location.href='<?= base_url('doctor') ?>'"
            class="nav-item flex flex-col items-center px-3.5 py-1.5 text-[#626260] hover:text-[#111111] transition-all rounded-[14px]">
            <?= icon('dashboard', 22, 'icon-nav w-5 h-5') ?>
            <span class="text-[11px] mt-0.5 font-medium">Beranda</span>
        </button>

        <button onclick="window.location.href='<?= base_url('doctor/consultation') ?>'"
            class="nav-item flex flex-col items-center px-3.5 py-1.5 text-[#626260] hover:text-[#111111] transition-all rounded-[14px]">
            <?= icon('appointments', 22, 'icon-nav w-5 h-5') ?>
            <span class="text-[11px] mt-0.5 font-medium">Jadwal</span>
        </button>

        <button onclick="window.location.href='<?= base_url('doctor/patients') ?>'"
            class="nav-item flex flex-col items-center px-3.5 py-1.5 text-[#626260] hover:text-[#111111] transition-all rounded-[14px]">
            <?= icon('patient', 22, 'icon-nav w-5 h-5') ?>
            <span class="text-[11px] mt-0.5 font-medium">Pasien</span>
        </button>

        <button onclick="window.location.href='<?= base_url('doctor/profile') ?>'"
            class="nav-item flex flex-col items-center px-3.5 py-1.5 text-[#626260] hover:text-[#111111] transition-all rounded-[14px]">
            <?= icon('profile', 22, 'icon-nav w-5 h-5') ?>
            <span class="text-[11px] mt-0.5 font-medium">Profil</span>
        </button>

    <?php else: ?>

        <button onclick="window.location.href='<?= base_url('patient') ?>'"
            class="nav-item flex flex-col items-center px-3 py-1.5 text-[#626260] hover:text-[#111111] transition-all rounded-[14px]">
            <?= icon('dashboard', 22, 'icon-nav w-5 h-5') ?>
            <span class="text-[11px] mt-0.5 font-medium">Beranda</span>
        </button>

        <button onclick="window.location.href='<?= base_url('patient/consultation') ?>'"
            class="nav-item flex flex-col items-center px-3 py-1.5 text-[#626260] hover:text-[#111111] transition-all rounded-[14px]">
            <?= icon('appointments', 22, 'icon-nav w-5 h-5') ?>
            <span class="text-[11px] mt-0.5 font-medium">Konsultasi</span>
        </button>

        <button onclick="window.location.href='<?= base_url('patient/history') ?>'"
            class="nav-item flex flex-col items-center px-3 py-1.5 text-[#626260] hover:text-[#111111] transition-all rounded-[14px]">
            <?= icon('medical_records', 22, 'icon-nav w-5 h-5') ?>
            <span class="text-[11px] mt-0.5 font-medium">Riwayat</span>
        </button>

        <button onclick="window.location.href='<?= base_url('patient/wellness') ?>'"
            class="nav-item flex flex-col items-center px-3 py-1.5 text-[#626260] hover:text-[#111111] transition-all rounded-[14px]">
            <?= icon('wellness', 22, 'icon-nav w-5 h-5') ?>
            <span class="text-[11px] mt-0.5 font-medium">Wellness</span>
        </button>

        <button onclick="window.location.href='<?= base_url('patient/profile') ?>'"
            class="nav-item flex flex-col items-center px-3 py-1.5 text-[#626260] hover:text-[#111111] transition-all rounded-[14px]">
            <?= icon('profile', 22, 'icon-nav w-5 h-5') ?>
            <span class="text-[11px] mt-0.5 font-medium">Profil</span>
        </button>

    <?php endif; ?>
</div>

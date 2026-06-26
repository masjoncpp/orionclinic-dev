<div id="bottom-nav" class="fixed bottom-0 left-0 right-0 bg-[#f5f1ec] border-t border-[#d3cec6] px-1 pt-2 pb-3 flex justify-around items-center md:hidden z-50">
    <?php if(session()->get('role') == 'doctor'): ?>

        <button onclick="window.location.href='<?= base_url('doctor') ?>'"
            class="nav-item flex flex-col items-center px-4 py-1 text-[#626260] hover:text-[#111111] transition-colors rounded-[8px]">
            <?= icon('dashboard', 24, 'icon-nav w-6 h-6') ?>
            <span class="text-[12px] mt-0.5 font-normal">Beranda</span>
        </button>

        <button onclick="window.location.href='<?= base_url('doctor/consultation') ?>'"
            class="nav-item flex flex-col items-center px-4 py-1 text-[#626260] hover:text-[#111111] transition-colors rounded-[8px]">
            <?= icon('appointments', 24, 'icon-nav w-6 h-6') ?>
            <span class="text-[12px] mt-0.5 font-normal">Jadwal</span>
        </button>

        <button onclick="window.location.href='<?= base_url('doctor/patients') ?>'"
            class="nav-item flex flex-col items-center px-4 py-1 text-[#626260] hover:text-[#111111] transition-colors rounded-[8px]">
            <?= icon('patient', 24, 'icon-nav w-6 h-6') ?>
            <span class="text-[12px] mt-0.5 font-normal">Pasien</span>
        </button>

        <button onclick="window.location.href='<?= base_url('doctor/profile') ?>'"
            class="nav-item flex flex-col items-center px-4 py-1 text-[#626260] hover:text-[#111111] transition-colors rounded-[8px]">
            <?= icon('profile', 24, 'icon-nav w-6 h-6') ?>
            <span class="text-[12px] mt-0.5 font-normal">Profil</span>
        </button>

    <?php else: ?>

        <button onclick="window.location.href='<?= base_url('patient') ?>'"
            class="nav-item flex flex-col items-center px-4 py-1 text-[#626260] hover:text-[#111111] transition-colors rounded-[8px]">
            <?= icon('dashboard', 24, 'icon-nav w-6 h-6') ?>
            <span class="text-[12px] mt-0.5 font-normal">Beranda</span>
        </button>

        <button onclick="window.location.href='<?= base_url('patient/consultation') ?>'"
            class="nav-item flex flex-col items-center px-4 py-1 text-[#626260] hover:text-[#111111] transition-colors rounded-[8px]">
            <?= icon('appointments', 24, 'icon-nav w-6 h-6') ?>
            <span class="text-[12px] mt-0.5 font-normal">Konsultasi</span>
        </button>

        <button onclick="window.location.href='<?= base_url('patient/wellness') ?>'"
            class="nav-item flex flex-col items-center px-4 py-1 text-[#626260] hover:text-[#111111] transition-colors rounded-[8px]">
            <?= icon('wellness', 24, 'icon-nav w-6 h-6') ?>
            <span class="text-[12px] mt-0.5 font-normal">Wellness</span>
        </button>

        <button onclick="window.location.href='<?= base_url('patient/profile') ?>'"
            class="nav-item flex flex-col items-center px-4 py-1 text-[#626260] hover:text-[#111111] transition-colors rounded-[8px]">
            <?= icon('profile', 24, 'icon-nav w-6 h-6') ?>
            <span class="text-[12px] mt-0.5 font-normal">Profil</span>
        </button>

    <?php endif; ?>
</div>

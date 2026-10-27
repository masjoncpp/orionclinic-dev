<!-- Desktop Sidebar -->
<aside class="hidden md:flex flex-col w-64 bg-[#ffffff] border-r border-[#d3cec6] h-full flex-shrink-0 z-40 shadow-[2px_0_16px_rgba(0,0,0,0.02)]">

    <!-- Logo -->
    <div class="px-6 py-5 flex items-center border-b border-[#ebe7e1]">
        <div class="w-11 h-11 bg-[#f5f1ec] rounded-[14px] p-1.5 flex items-center justify-center mr-3 flex-shrink-0 border border-[#d3cec6]/60">
            <img src="<?= base_url('assets/img/logoorion.png') ?>" alt="Orion Clinic Logo" class="w-full h-full object-contain">
        </div>
        <div>
            <h1 class="text-[16px] font-extrabold text-[#003E7E] leading-tight tracking-tight">Orion Clinic</h1>
            <p class="text-[11px] font-medium text-[#1BA098]">Layanan Telemedisin</p>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto px-3.5 py-4 space-y-1">

        <?php if(session()->get('role') == 'admin'): ?>
            <p class="text-[11px] font-bold uppercase tracking-wider text-[#7b7b78] px-3 mb-2">Menu Admin</p>

            <button onclick="window.location.href='<?= base_url('admin') ?>'"
                class="sidebar-nav-btn w-full flex items-center space-x-3 px-3.5 py-2.5 text-[#111111] rounded-[12px] hover:bg-[#f5f1ec] transition-all group">
                <?= icon('dashboard', 20, 'icon-nav w-5 h-5 flex-shrink-0') ?>
                <span class="font-medium text-[14px]">Dashboard</span>
            </button>

            <button onclick="window.location.href='<?= base_url('admin/doctors') ?>'"
                class="sidebar-nav-btn w-full flex items-center space-x-3 px-3.5 py-2.5 text-[#111111] rounded-[12px] hover:bg-[#f5f1ec] transition-all group">
                <svg class="icon-nav w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                <span class="font-medium text-[14px]">Kelola Dokter</span>
            </button>
            
            <button onclick="window.location.href='<?= base_url('admin/patients') ?>'"
                class="sidebar-nav-btn w-full flex items-center space-x-3 px-3.5 py-2.5 text-[#111111] rounded-[12px] hover:bg-[#f5f1ec] transition-all group">
                <svg class="icon-nav w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                <span class="font-medium text-[14px]">Kelola Pasien</span>
            </button>
            
            <button onclick="window.location.href='<?= base_url('admin/specializations') ?>'"
                class="sidebar-nav-btn w-full flex items-center space-x-3 px-3.5 py-2.5 text-[#111111] rounded-[12px] hover:bg-[#f5f1ec] transition-all group">
                <svg class="icon-nav w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                <span class="font-medium text-[14px]">Spesialisasi</span>
            </button>

            <button onclick="window.location.href='<?= base_url('admin/users') ?>'"
                class="sidebar-nav-btn w-full flex items-center space-x-3 px-3.5 py-2.5 text-[#111111] rounded-[12px] hover:bg-[#f5f1ec] transition-all group">
                <?= icon('patient', 20, 'icon-nav w-5 h-5 flex-shrink-0') ?>
                <span class="font-medium text-[14px]">Semua Akun</span>
            </button>

            <button onclick="window.location.href='<?= base_url('admin/transactions') ?>'"
                class="sidebar-nav-btn w-full flex items-center space-x-3 px-3.5 py-2.5 text-[#111111] rounded-[12px] hover:bg-[#f5f1ec] transition-all group">
                <?= icon('receipt', 20, 'icon-nav w-5 h-5 flex-shrink-0') ?>
                <span class="font-medium text-[14px]">Keuangan</span>
            </button>
            
            <button onclick="window.location.href='<?= base_url('admin/logs') ?>'"
                class="sidebar-nav-btn w-full flex items-center space-x-3 px-3.5 py-2.5 text-[#111111] rounded-[12px] hover:bg-[#f5f1ec] transition-all group">
                <svg class="icon-nav w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <span class="font-medium text-[14px]">Audit Log</span>
            </button>

        <?php elseif(session()->get('role') == 'farmasi'): ?>

            <p class="text-[11px] font-bold uppercase tracking-wider text-[#7b7b78] px-3 mb-2">Menu Farmasi</p>

            <button onclick="window.location.href='<?= base_url('pharmacy') ?>'"
                class="sidebar-nav-btn w-full flex items-center space-x-3 px-3.5 py-2.5 text-[#111111] rounded-[12px] hover:bg-[#f5f1ec] transition-all group">
                <?= icon('prescription', 20, 'icon-nav w-5 h-5 flex-shrink-0') ?>
                <span class="font-medium text-[14px]">Antrean Resep</span>
            </button>

        <?php elseif(session()->get('role') == 'doctor'): ?>

            <p class="text-[11px] font-bold uppercase tracking-wider text-[#7b7b78] px-3 mb-2">Menu Dokter</p>

            <button onclick="window.location.href='<?= base_url('doctor') ?>'"
                class="sidebar-nav-btn w-full flex items-center space-x-3 px-3.5 py-2.5 text-[#111111] rounded-[12px] hover:bg-[#f5f1ec] transition-all group">
                <?= icon('dashboard', 20, 'icon-nav w-5 h-5 flex-shrink-0') ?>
                <span class="font-medium text-[14px]">Dashboard</span>
            </button>

            <button onclick="window.location.href='<?= base_url('doctor/schedules') ?>'"
                class="sidebar-nav-btn w-full flex items-center space-x-3 px-3.5 py-2.5 text-[#111111] rounded-[12px] hover:bg-[#f5f1ec] transition-all group">
                <svg class="icon-nav w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="font-medium text-[14px]">Atur Jadwal</span>
            </button>

            <button onclick="window.location.href='<?= base_url('doctor/consultation') ?>'"
                class="sidebar-nav-btn w-full flex items-center space-x-3 px-3.5 py-2.5 text-[#111111] rounded-[12px] hover:bg-[#f5f1ec] transition-all group">
                <?= icon('appointments', 20, 'icon-nav w-5 h-5 flex-shrink-0') ?>
                <span class="font-medium text-[14px]">Jadwal Konsultasi</span>
            </button>

            <button onclick="window.location.href='<?= base_url('doctor/patients') ?>'"
                class="sidebar-nav-btn w-full flex items-center space-x-3 px-3.5 py-2.5 text-[#111111] rounded-[12px] hover:bg-[#f5f1ec] transition-all group">
                <?= icon('patient', 20, 'icon-nav w-5 h-5 flex-shrink-0') ?>
                <span class="font-medium text-[14px]">Data Pasien</span>
            </button>

            <button onclick="window.location.href='<?= base_url('doctor/chat') ?>'"
                class="sidebar-nav-btn w-full flex items-center space-x-3 px-3.5 py-2.5 text-[#111111] rounded-[12px] hover:bg-[#f5f1ec] transition-all group">
                <?= icon('chat', 20, 'icon-nav w-5 h-5 flex-shrink-0') ?>
                <span class="font-medium text-[14px]">Chat Pasien</span>
            </button>

            <button onclick="window.location.href='<?= base_url('doctor/profile') ?>'"
                class="sidebar-nav-btn w-full flex items-center space-x-3 px-3.5 py-2.5 text-[#111111] rounded-[12px] hover:bg-[#f5f1ec] transition-all group">
                <?= icon('profile', 20, 'icon-nav w-5 h-5 flex-shrink-0') ?>
                <span class="font-medium text-[14px]">Profil Dokter</span>
            </button>

        <?php else: ?>

            <p class="text-[11px] font-bold uppercase tracking-wider text-[#7b7b78] px-3 mb-2">Menu Utama</p>

            <button onclick="window.location.href='<?= base_url('patient') ?>'"
                class="sidebar-nav-btn w-full flex items-center space-x-3 px-3.5 py-2.5 text-[#111111] rounded-[12px] hover:bg-[#f5f1ec] transition-all group">
                <?= icon('dashboard', 20, 'icon-nav w-5 h-5 flex-shrink-0') ?>
                <span class="font-medium text-[14px]">Beranda</span>
            </button>

            <button onclick="window.location.href='<?= base_url('patient/consultation') ?>'"
                class="sidebar-nav-btn w-full flex items-center space-x-3 px-3.5 py-2.5 text-[#111111] rounded-[12px] hover:bg-[#f5f1ec] transition-all group">
                <?= icon('appointments', 20, 'icon-nav w-5 h-5 flex-shrink-0') ?>
                <span class="font-medium text-[14px]">Konsultasi Dokter</span>
            </button>

            <button onclick="window.location.href='<?= base_url('patient/prescription') ?>'"
                class="sidebar-nav-btn w-full flex items-center space-x-3 px-3.5 py-2.5 text-[#111111] rounded-[12px] hover:bg-[#f5f1ec] transition-all group">
                <?= icon('prescription', 20, 'icon-nav w-5 h-5 flex-shrink-0') ?>
                <span class="font-medium text-[14px]">Resep & Obat</span>
            </button>

            <button onclick="window.location.href='<?= base_url('patient/wellness') ?>'"
                class="sidebar-nav-btn w-full flex items-center space-x-3 px-3.5 py-2.5 text-[#111111] rounded-[12px] hover:bg-[#f5f1ec] transition-all group">
                <?= icon('wellness', 20, 'icon-nav w-5 h-5 flex-shrink-0') ?>
                <span class="font-medium text-[14px]">Wellness</span>
            </button>

            <button onclick="window.location.href='<?= base_url('patient/history') ?>'"
                class="sidebar-nav-btn w-full flex items-center space-x-3 px-3.5 py-2.5 text-[#111111] rounded-[12px] hover:bg-[#f5f1ec] transition-all group">
                <?= icon('medical_records', 20, 'icon-nav w-5 h-5 flex-shrink-0') ?>
                <span class="font-medium text-[14px]">Riwayat Kesehatan</span>
            </button>

            <button onclick="window.location.href='<?= base_url('patient/payments') ?>'"
                class="sidebar-nav-btn w-full flex items-center space-x-3 px-3.5 py-2.5 text-[#111111] rounded-[12px] hover:bg-[#f5f1ec] transition-all group">
                <svg class="icon-nav w-5 h-5 flex-shrink-0 text-[#626260]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                <span class="font-medium text-[14px]">Riwayat Pembayaran</span>
            </button>

            <button onclick="window.location.href='<?= base_url('patient/profile') ?>'"
                class="sidebar-nav-btn w-full flex items-center space-x-3 px-3.5 py-2.5 text-[#111111] rounded-[12px] hover:bg-[#f5f1ec] transition-all group">
                <?= icon('profile', 20, 'icon-nav w-5 h-5 flex-shrink-0') ?>
                <span class="font-medium text-[14px]">Profil Saya</span>
            </button>

        <?php endif; ?>
    </nav>

    <!-- User Info & Logout Footer -->
    <div class="p-4 border-t border-[#ebe7e1] bg-[#f9f8f6]">
        <div class="flex items-center mb-3 px-2">
            <div class="w-9 h-9 rounded-full bg-[#003E7E] text-white flex items-center justify-center font-bold text-xs mr-2.5 flex-shrink-0">
                <?= esc(mb_strtoupper(mb_substr(session()->get('name') ?? 'U', 0, 1))) ?>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-xs font-bold text-[#111111] truncate"><?= esc(session()->get('name') ?? 'Pengguna') ?></p>
                <p class="text-[11px] text-[#7b7b78] capitalize truncate"><?= esc(session()->get('role') ?? 'Pasien') ?></p>
            </div>
        </div>
        <button onclick="window.location.href='<?= base_url('logout') ?>'"
            class="w-full flex items-center justify-center space-x-2 px-3 py-2 text-[#c41c1c] bg-red-50/70 rounded-[10px] hover:bg-red-100/80 transition-all">
            <?= icon('logout', 18, 'w-4 h-4 flex-shrink-0') ?>
            <span class="font-bold text-xs">Keluar Akun</span>
        </button>
    </div>

</aside>

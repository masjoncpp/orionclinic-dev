<?php
?>

<!-- ===== DESKTOP TOP NAVBAR ===== -->
<header class="hidden md:block fixed top-0 left-0 right-0 z-40 bg-[#f5f1ec]/95 backdrop-blur-md border-b border-[#d3cec6] transition-all">
    <div class="max-w-7xl mx-auto px-7 h-[64px] flex items-center justify-between">

        <!-- Brand Logo -->
        <a href="<?= base_url('/') ?>" class="flex items-center space-x-2.5 group">
            <div class="w-9 h-9 bg-[#ffffff] rounded-[10px] p-1 flex items-center justify-center border border-[#d3cec6] shadow-sm group-hover:scale-105 transition-transform">
                <img src="<?= base_url('assets/img/logoorion.png') ?>" alt="Orion Clinic" class="w-full h-full object-contain">
            </div>
            <div>
                <span class="text-[16px] font-extrabold text-[#003E7E] tracking-tight block leading-none">Orion Clinic</span>
                <span class="text-[10px] font-semibold text-[#1BA098] tracking-wide">TELEMEDISIN</span>
            </div>
        </a>

        <!-- Nav Links -->
        <nav class="flex items-center gap-1">
            <a href="<?= base_url('/#hero') ?>"       class="sidebar-link px-3.5 py-2 text-[#111111] font-medium text-[14px] hover:text-[#003E7E]">Beranda</a>
            <a href="<?= base_url('/#tentang') ?>"    class="sidebar-link px-3.5 py-2 text-[#111111] font-medium text-[14px] hover:text-[#003E7E]">Tentang Kami</a>
            <a href="<?= base_url('/#layanan') ?>"    class="sidebar-link px-3.5 py-2 text-[#111111] font-medium text-[14px] hover:text-[#003E7E]">Layanan</a>
            <a href="<?= base_url('/#cara-kerja') ?>" class="sidebar-link px-3.5 py-2 text-[#111111] font-medium text-[14px] hover:text-[#003E7E]">Cara Kerja</a>
            <a href="<?= base_url('/#statistik') ?>"  class="sidebar-link px-3.5 py-2 text-[#111111] font-medium text-[14px] hover:text-[#003E7E]">Statistik</a>
            <a href="<?= base_url('mitra-dokter') ?>" class="sidebar-link px-3.5 py-2 text-[#003E7E] font-bold text-[14px]">Gabung Dokter</a>
        </nav>

        <!-- Auth Buttons (pojok kanan atas) -->
        <div class="flex items-center gap-2.5">
            <a href="<?= base_url('auth/login') ?>"
               class="px-4 py-2 rounded-[12px] bg-[#ffffff] text-[#111111] font-semibold text-[14px] border border-[#d3cec6] hover:bg-[#ebe7e1] transition-all">
                Masuk
            </a>
            <a href="<?= base_url('register') ?>"
               class="px-4 py-2 rounded-[12px] bg-[#003E7E] text-[#ffffff] font-semibold text-[14px] hover:bg-[#002855] shadow-sm transition-all">
                Daftar Sekarang
            </a>
        </div>
    </div>
</header>

<!-- ===== MOBILE TOPBAR ===== -->
<div class="md:hidden fixed top-0 left-0 right-0 z-50 bg-[#f5f1ec]/95 backdrop-blur-md border-b border-[#d3cec6] px-4 py-3 flex items-center justify-between h-[56px]">
    <a href="<?= base_url('/') ?>" class="flex items-center space-x-2">
        <img src="<?= base_url('assets/img/logoorion.png') ?>" alt="Orion Clinic" class="w-8 h-8 object-contain">
        <span class="text-[16px] font-extrabold text-[#003E7E]">Orion Clinic</span>
    </a>
    <div class="flex items-center space-x-2">
        <a href="<?= base_url('auth/login') ?>" class="text-[#111111] font-semibold text-[13px] px-3 py-1.5 rounded-[10px] bg-[#ffffff] border border-[#d3cec6]">Masuk</a>
        <button id="burger-btn" onclick="toggleMobileMenu()" class="p-2 rounded-lg text-[#111111] hover:bg-[#ebe7e1]">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>
</div>

<!-- ===== MOBILE MENU OVERLAY (slide dari kanan) ===== -->
<div id="mobile-menu" class="md:hidden fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black bg-opacity-40" onclick="toggleMobileMenu()"></div>
    <div class="mobile-panel absolute top-0 right-0 bottom-0 w-72 bg-[#f5f1ec] flex flex-col shadow-2xl">
        <div class="px-6 py-4 border-b border-[#d3cec6] flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <img src="<?= base_url('assets/img/logoorion.png') ?>" alt="Orion Clinic" class="w-9 h-9 object-contain">
                <span class="font-bold text-[#003E7E]">Orion Clinic</span>
            </div>
            <button onclick="toggleMobileMenu()" class="p-1 rounded-lg text-[#626260] hover:text-[#111111]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
            <a href="<?= base_url('/#hero') ?>"       onclick="toggleMobileMenu()" class="flex items-center px-3 py-2.5 text-[#111111] rounded-[10px] hover:bg-[#ebe7e1] font-medium text-[15px]">Beranda</a>
            <a href="<?= base_url('/#tentang') ?>"    onclick="toggleMobileMenu()" class="flex items-center px-3 py-2.5 text-[#111111] rounded-[10px] hover:bg-[#ebe7e1] font-medium text-[15px]">Tentang Kami</a>
            <a href="<?= base_url('/#layanan') ?>"    onclick="toggleMobileMenu()" class="flex items-center px-3 py-2.5 text-[#111111] rounded-[10px] hover:bg-[#ebe7e1] font-medium text-[15px]">Layanan</a>
            <a href="<?= base_url('/#cara-kerja') ?>" onclick="toggleMobileMenu()" class="flex items-center px-3 py-2.5 text-[#111111] rounded-[10px] hover:bg-[#ebe7e1] font-medium text-[15px]">Cara Kerja</a>
            <a href="<?= base_url('/#statistik') ?>"  onclick="toggleMobileMenu()" class="flex items-center px-3 py-2.5 text-[#111111] rounded-[10px] hover:bg-[#ebe7e1] font-medium text-[15px]">Statistik</a>
            <a href="<?= base_url('mitra-dokter') ?>" onclick="toggleMobileMenu()" class="flex items-center px-3 py-2.5 text-[#003E7E] rounded-[10px] hover:bg-[#ebe7e1] font-bold text-[15px]">Gabung Dokter</a>
        </nav>
        <div class="px-4 py-4 border-t border-[#d3cec6] space-y-2">
            <a href="<?= base_url('auth/login') ?>"  class="block w-full text-center px-4 py-2.5 rounded-[12px] bg-[#ffffff] text-[#111111] border border-[#d3cec6] font-semibold text-[14px]">Masuk</a>
            <a href="<?= base_url('register') ?>" class="block w-full text-center px-4 py-2.5 rounded-[12px] bg-[#003E7E] text-[#ffffff] font-semibold text-[14px]">Daftar Sekarang</a>
        </div>
    </div>
</div>
<script>
function toggleMobileMenu() {
    const menu = document.getElementById('mobile-menu');
    if (!menu) return;
    if (menu.classList.contains('hidden')) {
        menu.classList.remove('hidden');
        setTimeout(() => menu.classList.add('open'), 10);
    } else {
        menu.classList.remove('open');
        setTimeout(() => menu.classList.add('hidden'), 300);
    }
}
</script>

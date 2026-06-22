<?php
?>

<!-- ===== DESKTOP TOP NAVBAR ===== -->
<header class="hidden md:block fixed top-0 left-0 right-0 z-40 bg-[#f5f1ec] border-b border-[#d3cec6] transition-all">
    <div class="max-w-7xl mx-auto px-7 h-[56px] flex items-center justify-between">

        <!-- Nav Links -->
        <nav class="flex items-center gap-2">
            <a href="#hero"       class="sidebar-link px-4 py-2 text-[#111111] font-normal text-[14px]">Beranda</a>
            <a href="#tentang"    class="sidebar-link px-4 py-2 text-[#111111] font-normal text-[14px]">Tentang Kami</a>
            <a href="#layanan"    class="sidebar-link px-4 py-2 text-[#111111] font-normal text-[14px]">Layanan</a>
            <a href="#cara-kerja" class="sidebar-link px-4 py-2 text-[#111111] font-normal text-[14px]">Cara Kerja</a>
            <a href="#statistik"  class="sidebar-link px-4 py-2 text-[#111111] font-normal text-[14px]">Statistik</a>
        </nav>

        <!-- Auth Buttons (pojok kanan atas) -->
        <div class="flex items-center gap-3">
            <a href="<?= base_url('auth/login') ?>"
               class="px-[18px] py-[10px] rounded-[8px] bg-[#ffffff] text-[#111111] font-medium text-[15px] border border-[#d3cec6] hover:bg-[#f5f1ec] transition-all">
                Masuk
            </a>
            <a href="<?= base_url('register') ?>"
               class="px-[18px] py-[10px] rounded-[8px] bg-[#003E7E] text-[#ffffff] font-medium text-[15px] hover:bg-[#002855] transition-all">
                Daftar Sekarang
            </a>
        </div>
    </div>
</header>

<!-- ===== MOBILE TOPBAR ===== -->
<div class="md:hidden fixed top-0 left-0 right-0 z-50 bg-[#f5f1ec] border-b border-[#d3cec6] px-4 py-3 flex items-center justify-between h-[56px]">
    <div class="flex items-center space-x-2">
        <img src="<?= base_url('assets/img/logoorion.png') ?>" alt="Orion Clinic" class="w-8 h-8 object-contain">
        <span class="text-[16px] font-bold text-[#111111]">Orion Clinic</span>
    </div>
    <div class="flex items-center space-x-2">
        <a href="<?= base_url('auth/login') ?>" class="text-[#111111] font-medium text-[14px] px-3 py-1.5 rounded-[8px] bg-[#ffffff] border border-[#d3cec6]">Masuk</a>
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
                <span class="font-bold text-[#111111]">Orion Clinic</span>
            </div>
            <button onclick="toggleMobileMenu()" class="p-1 rounded-lg text-[#626260] hover:text-[#111111]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
            <a href="#hero"       onclick="toggleMobileMenu()" class="flex items-center px-3 py-2.5 text-[#111111] rounded-[8px] hover:bg-[#ebe7e1] font-normal text-[16px]">Beranda</a>
            <a href="#tentang"    onclick="toggleMobileMenu()" class="flex items-center px-3 py-2.5 text-[#111111] rounded-[8px] hover:bg-[#ebe7e1] font-normal text-[16px]">Tentang Kami</a>
            <a href="#layanan"    onclick="toggleMobileMenu()" class="flex items-center px-3 py-2.5 text-[#111111] rounded-[8px] hover:bg-[#ebe7e1] font-normal text-[16px]">Layanan</a>
            <a href="#cara-kerja" onclick="toggleMobileMenu()" class="flex items-center px-3 py-2.5 text-[#111111] rounded-[8px] hover:bg-[#ebe7e1] font-normal text-[16px]">Cara Kerja</a>
            <a href="#statistik"  onclick="toggleMobileMenu()" class="flex items-center px-3 py-2.5 text-[#111111] rounded-[8px] hover:bg-[#ebe7e1] font-normal text-[16px]">Statistik</a>
        </nav>
        <div class="px-4 py-4 border-t border-[#d3cec6] space-y-2">
            <a href="<?= base_url('auth/login') ?>"  class="block w-full text-center px-[18px] py-[10px] rounded-[8px] bg-[#ffffff] text-[#111111] border border-[#d3cec6] font-medium text-[15px]">Masuk</a>
            <a href="<?= base_url('register') ?>" class="block w-full text-center px-[18px] py-[10px] rounded-[8px] bg-[#003E7E] text-[#ffffff] font-medium text-[15px]">Daftar Sekarang</a>
        </div>
    </div>
</div>

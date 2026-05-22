<?php
?>

<!-- ===== DESKTOP TOP NAVBAR ===== -->
<header class="hidden md:block fixed top-0 left-0 right-0 z-40 bg-white/90 backdrop-blur-md border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-7 h-16 flex items-center justify-between">

        <!-- Nav Links -->
        <nav class="flex items-center gap-2">
            <a href="#hero"       class="sidebar-link px-4 py-2 text-gray-600 font-medium text-sm">Beranda</a>
            <a href="#tentang"    class="sidebar-link px-4 py-2 text-gray-600 font-medium text-sm">Tentang Kami</a>
            <a href="#layanan"    class="sidebar-link px-4 py-2 text-gray-600 font-medium text-sm">Layanan</a>
            <a href="#cara-kerja" class="sidebar-link px-4 py-2 text-gray-600 font-medium text-sm">Cara Kerja</a>
            <a href="#statistik"  class="sidebar-link px-4 py-2 text-gray-600 font-medium text-sm">Statistik</a>
        </nav>

        <!-- Auth Buttons (pojok kanan atas) -->
        <div class="flex items-center gap-3">
            <a href="<?= base_url('auth/login') ?>"
               class="px-5 py-2 rounded-xl border-2 border-blue-600 text-blue-600 font-semibold text-sm hover:bg-blue-50 transition-all">
                Masuk
            </a>
            <a href="<?= base_url('register') ?>"
               class="gradient-btn px-5 py-2 rounded-xl text-white font-semibold text-sm transition-all">
                Daftar Sekarang
            </a>
        </div>
    </div>
</header>

<!-- ===== MOBILE TOPBAR ===== -->
<div class="md:hidden fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-100 px-4 py-3 flex items-center justify-between">
    <div class="flex items-center space-x-2">
        <img src="<?= base_url('assets/img/logoorion.png') ?>" alt="Orion Clinic" class="w-8 h-8 object-contain">
        <span class="text-base font-bold text-gray-800">Orion Clinic</span>
    </div>
    <div class="flex items-center space-x-2">
        <a href="<?= base_url('auth/login') ?>" class="text-blue-600 font-semibold text-sm px-3 py-1.5 rounded-lg border border-blue-200">Masuk</a>
        <button id="burger-btn" onclick="toggleMobileMenu()" class="p-2 rounded-lg text-gray-600 hover:bg-gray-100">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>
</div>

<!-- ===== MOBILE MENU OVERLAY (slide dari kanan) ===== -->
<div id="mobile-menu" class="md:hidden fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black bg-opacity-40" onclick="toggleMobileMenu()"></div>
    <div class="mobile-panel absolute top-0 right-0 bottom-0 w-72 bg-white flex flex-col shadow-2xl">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <img src="<?= base_url('assets/img/logoorion.png') ?>" alt="Orion Clinic" class="w-9 h-9 object-contain">
                <span class="font-bold text-gray-800">Orion Clinic</span>
            </div>
            <button onclick="toggleMobileMenu()" class="p-1 rounded-lg text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
            <a href="#hero"       onclick="toggleMobileMenu()" class="flex items-center px-3 py-2.5 text-gray-700 rounded-xl hover:bg-blue-50 font-medium text-sm">Beranda</a>
            <a href="#tentang"    onclick="toggleMobileMenu()" class="flex items-center px-3 py-2.5 text-gray-700 rounded-xl hover:bg-blue-50 font-medium text-sm">Tentang Kami</a>
            <a href="#layanan"    onclick="toggleMobileMenu()" class="flex items-center px-3 py-2.5 text-gray-700 rounded-xl hover:bg-blue-50 font-medium text-sm">Layanan</a>
            <a href="#cara-kerja" onclick="toggleMobileMenu()" class="flex items-center px-3 py-2.5 text-gray-700 rounded-xl hover:bg-blue-50 font-medium text-sm">Cara Kerja</a>
            <a href="#statistik"  onclick="toggleMobileMenu()" class="flex items-center px-3 py-2.5 text-gray-700 rounded-xl hover:bg-blue-50 font-medium text-sm">Statistik</a>
        </nav>
        <div class="px-4 py-4 border-t border-gray-100 space-y-2">
            <a href="<?= base_url('auth/login') ?>"  class="block w-full text-center px-4 py-2.5 rounded-xl border-2 border-blue-600 text-blue-600 font-semibold text-sm">Masuk</a>
            <a href="<?= base_url('register') ?>" class="gradient-btn block w-full text-center px-4 py-2.5 rounded-xl text-white font-semibold text-sm">Daftar Sekarang</a>
        </div>
    </div>
</div>

<?php
/**
 * Sidebar komponen untuk Landing Page
 * Berisi: desktop sidebar, mobile topbar, mobile menu overlay
 */
?>

<!-- ===== DESKTOP SIDEBAR ===== -->
<aside class="hidden md:flex flex-col w-72 bg-white border-r border-gray-100 h-screen fixed top-0 left-0 z-40 overflow-y-auto">

    <!-- Logo -->
    <div class="px-6 py-6 border-b border-gray-100">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 bg-blue-50">
                <img src="<?= base_url('assets/img/logoorion.png') ?>" alt="Orion Clinic" class="w-10 h-10 object-contain">
            </div>
            <div>
                <h1 class="text-base font-bold text-gray-800 leading-tight">Orion Clinic</h1>
                <p class="text-xs text-blue-500 font-medium">Platform Telemedisin</p>
            </div>
        </div>
    </div>

    <!-- Nav Links -->
    <nav class="flex-1 px-4 py-6 space-y-1">
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 mb-3">Navigasi</p>

        <a href="#hero" class="sidebar-link flex items-center space-x-3 px-3 py-2.5 text-gray-600 rounded-xl">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            <span class="font-medium text-sm">Beranda</span>
        </a>

        <a href="#tentang" class="sidebar-link flex items-center space-x-3 px-3 py-2.5 text-gray-600 rounded-xl">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="font-medium text-sm">Tentang Kami</span>
        </a>

        <a href="#layanan" class="sidebar-link flex items-center space-x-3 px-3 py-2.5 text-gray-600 rounded-xl">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
            <span class="font-medium text-sm">Layanan</span>
        </a>

        <a href="#cara-kerja" class="sidebar-link flex items-center space-x-3 px-3 py-2.5 text-gray-600 rounded-xl">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
            </svg>
            <span class="font-medium text-sm">Cara Kerja</span>
        </a>

        <a href="#statistik" class="sidebar-link flex items-center space-x-3 px-3 py-2.5 text-gray-600 rounded-xl">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            <span class="font-medium text-sm">Statistik</span>
        </a>
    </nav>

    <!-- Auth Buttons -->
    <div class="px-4 py-5 border-t border-gray-100 space-y-2">
        <a href="<?= base_url('auth/login') ?>"
           class="block w-full text-center px-4 py-2.5 rounded-xl border-2 border-blue-600 text-blue-600 font-semibold text-sm hover:bg-blue-50 transition-all">
            Masuk
        </a>
        <a href="<?= base_url('register') ?>"
           class="gradient-btn block w-full text-center px-4 py-2.5 rounded-xl text-white font-semibold text-sm transition-all">
            Daftar Sekarang
        </a>
    </div>
</aside>

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

<!-- ===== MOBILE MENU OVERLAY ===== -->
<div id="mobile-menu" class="md:hidden fixed inset-0 z-40 hidden">
    <div class="absolute inset-0 bg-black bg-opacity-40" onclick="toggleMobileMenu()"></div>
    <div class="absolute top-0 left-0 bottom-0 w-72 bg-white flex flex-col">
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

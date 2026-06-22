<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="profile-screen" class="flex flex-col h-full bg-[#f5f1ec] fade-in">

    <div class="flex-1 overflow-y-auto pb-20 md:pb-6">

        <!-- Profile Header -->
        <div class="bg-[#003E7E] relative overflow-hidden px-5 pt-8 pb-20 md:pb-24">

                    <!-- Decorative Ornaments -->
                    <div class="absolute inset-0 pointer-events-none overflow-hidden z-0">
                        <!-- Soft Gradient Circles -->
                        <div class="absolute -top-24 -right-24 w-96 h-96 bg-white opacity-[0.03] rounded-full blur-3xl"></div>
                        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-[#1BA098] opacity-[0.15] rounded-full blur-3xl"></div>
                        
                        <!-- Wavy SVG Accent -->
                        <svg class="absolute top-0 right-0 w-full h-full opacity-[0.04]" viewBox="0 0 100 100" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0,50 Q25,20 50,50 T100,50 L100,0 L0,0 Z" fill="currentColor" class="text-white"/>
                            <path d="M0,80 Q25,50 50,80 T100,80 L100,100 L0,100 Z" fill="currentColor" class="text-[#1BA098]"/>
                        </svg>

                        <!-- Subtle Grid Pattern -->
                        <div class="absolute inset-0" style="background-image: radial-gradient(rgba(255,255,255,0.1) 1.5px, transparent 1.5px); background-size: 24px 24px;"></div>
                        
                        <!-- Accent Medical Crosses -->
                        <svg class="absolute top-10 right-1/4 w-8 h-8 text-white opacity-[0.08]" fill="currentColor" viewBox="0 0 24 24"><path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6v-2z"/></svg>
                        <svg class="absolute bottom-10 left-1/3 w-12 h-12 text-[#1BA098] opacity-[0.12] transform rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6v-2z"/></svg>
                    </div>

            <h1 class="text-base font-bold text-white mb-5">Profil Saya</h1>
            <div class="flex items-center">
                <div class="relative mr-4">
                    <img src="<?= base_url('assets/profile.png') ?>" alt="Profile"
                        class="w-16 h-16 rounded-[24px] object-cover border-2 border-white/30">
                    <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-400 rounded-full border-2 border-white"></div>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-white"><?= esc(session()->get('name') ?? 'Pengguna') ?></h2>
                    <p class="text-white/60 text-xs mt-0.5"><?= esc(session()->get('email') ?? '-') ?></p>
                    <p class="text-white/60 text-xs"><?= esc(session()->get('phone') ?? '-') ?></p>
                </div>
            </div>
        </div>

        <div class="px-5 max-w-2xl mx-auto">

            <!-- Family Members -->
            <div class="-mt-10 mb-5 relative z-10">
                <div class="bg-[#ffffff] rounded-[24px]  p-4">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="font-bold text-[#111111] text-sm">Anggota Keluarga</h3>
                        <button class="text-xs text-[#111111] font-bold bg-[#ebe7e1] px-3 py-1.5 rounded-[12px] hover:bg-[#ebe7e1] transition-all">+ Tambah</button>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center p-3 bg-[#f5f1ec] rounded-[16px] hover:bg-[#f5f1ec] transition-all cursor-pointer">
                            <div class="w-9 h-9 bg-pink-100 rounded-[16px] flex items-center justify-center mr-3 flex-shrink-0">
                                <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h5 class="font-semibold text-[#111111] text-sm">Sari Santoso</h5>
                                <p class="text-xs text-[#7b7b78]">Istri • 35 tahun</p>
                            </div>
                            <svg class="w-4 h-4 text-[#7b7b78]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                        <div class="flex items-center p-3 bg-[#f5f1ec] rounded-[16px] hover:bg-[#f5f1ec] transition-all cursor-pointer">
                            <div class="w-9 h-9 bg-[#ebe7e1] rounded-[16px] flex items-center justify-center mr-3 flex-shrink-0">
                                <svg class="w-4 h-4 text-[#111111]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h5 class="font-semibold text-[#111111] text-sm">Anisa Santoso</h5>
                                <p class="text-xs text-[#7b7b78]">Anak • 8 tahun</p>
                            </div>
                            <svg class="w-4 h-4 text-[#7b7b78]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                        <div class="flex items-center p-3 bg-[#f5f1ec] rounded-[16px] hover:bg-[#f5f1ec] transition-all cursor-pointer">
                            <div class="w-9 h-9 bg-[#ebe7e1] rounded-[16px] flex items-center justify-center mr-3 flex-shrink-0">
                                <svg class="w-4 h-4 text-[#111111]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h5 class="font-semibold text-[#111111] text-sm">Raka Santoso</h5>
                                <p class="text-xs text-[#7b7b78]">Anak • 5 tahun</p>
                            </div>
                            <svg class="w-4 h-4 text-[#7b7b78]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu Items -->
            <div class="bg-[#ffffff] rounded-[24px]  overflow-hidden mb-6">
                <button class="w-full flex items-center p-4 hover:bg-[#f5f1ec] transition-all border-b border-gray-50">
                    <div class="w-9 h-9 bg-[#ebe7e1] rounded-[16px] flex items-center justify-center mr-3 flex-shrink-0">
                        <svg class="w-4 h-4 text-[#111111]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <span class="flex-1 text-left font-semibold text-[#111111] text-sm">Edit Profil</span>
                    <svg class="w-4 h-4 text-[#7b7b78]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <button class="w-full flex items-center p-4 hover:bg-[#f5f1ec] transition-all border-b border-gray-50">
                    <div class="w-9 h-9 bg-teal-50 rounded-[16px] flex items-center justify-center mr-3 flex-shrink-0">
                        <svg class="w-4 h-4 text-[#111111]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                    </div>
                    <span class="flex-1 text-left font-semibold text-[#111111] text-sm">Metode Pembayaran</span>
                    <svg class="w-4 h-4 text-[#7b7b78]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <button class="w-full flex items-center p-4 hover:bg-[#f5f1ec] transition-all border-b border-gray-50">
                    <div class="w-9 h-9 bg-purple-50 rounded-[16px] flex items-center justify-center mr-3 flex-shrink-0">
                        <svg class="w-4 h-4 text-[#111111]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                    <span class="flex-1 text-left font-semibold text-[#111111] text-sm">Notifikasi</span>
                    <svg class="w-4 h-4 text-[#7b7b78]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <button class="w-full flex items-center p-4 hover:bg-[#f5f1ec] transition-all">
                    <div class="w-9 h-9 bg-orange-50 rounded-[16px] flex items-center justify-center mr-3 flex-shrink-0">
                        <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="flex-1 text-left font-semibold text-[#111111] text-sm">Bantuan & FAQ</span>
                    <svg class="w-4 h-4 text-[#7b7b78]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>

            <!-- Logout -->
            <div class="bg-[#ffffff] rounded-[24px]  overflow-hidden mb-6">
                <button onclick="window.location.href='<?= base_url('logout') ?>'"
                    class="w-full flex items-center p-4 hover:bg-red-50 transition-all">
                    <div class="w-9 h-9 bg-red-50 rounded-[16px] flex items-center justify-center mr-3 flex-shrink-0">
                        <svg class="w-4 h-4 text-[#E53935]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </div>
                    <span class="flex-1 text-left font-semibold text-[#E53935] text-sm">Keluar dari Akun</span>
                </button>
            </div>

            <p class="text-center text-xs text-[#7b7b78] mb-4">Orion Clinic v1.0.0</p>

        </div>
    </div>

</div>
<?= $this->include('components/bottom_nav') ?>
<?= $this->endSection() ?>

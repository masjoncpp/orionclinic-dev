<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="profile-screen" class="flex flex-col h-full w-full bg-gray-50 flex-1 relative">
            <div class="flex-1 overflow-auto pb-20">
                <div class="bg-gradient-to-br from-blue-600 to-blue-800 px-6 pt-10 pb-16">
                    <div class="flex flex-col items-center">
                        <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center border-4 border-white pb-1 shadow-lg text-white font-bold text-3xl mb-4">
                            <?php 
                                $name = session()->get('name') ?? 'Doctor';
                                $initials = substr($name, 0, 1);
                                $lastSpace = strrpos($name, ' ');
                                if ($lastSpace !== false) {
                                    $initials .= substr($name, $lastSpace + 1, 1);
                                }
                                echo esc(strtoupper($initials));
                            ?>
                        </div>
                        <h2 class="text-white font-bold text-2xl"><?= esc($name) ?></h2>
                        <p class="text-blue-100 text-sm mt-1">Status: <?= ucfirst($role) ?></p>
                        <p class="text-blue-100 text-sm">Orion Clinic Telemedicine Team</p>
                    </div>
                </div>
                <div class="px-6 -mt-8 space-y-4">
                    <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100">
                        <h4 class="font-bold text-gray-800 mb-4 border-b border-gray-100 pb-2">Informasi Kontak</h4>
                        <div class="space-y-3">
                            <div class="flex items-center text-sm">
                                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <span class="text-gray-700"><?= esc(session()->get('phone') ?? '-') ?></span>
                            </div>
                            <div class="flex items-center text-sm">
                                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <span class="text-gray-700"><?= esc(session()->get('email') ?? '-') ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100">
                        <h4 class="font-bold text-gray-800 mb-4 border-b border-gray-100 pb-2">Pengaturan</h4>
                        <div class="space-y-3">
                            <button class="w-full flex items-center justify-between text-left text-sm py-2 group">
                                <div class="flex items-center text-gray-700 group-hover:text-blue-600 transition-colors">
                                    <svg class="w-5 h-5 text-gray-400 mr-3 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                    Ubah Kata Sandi
                                </div>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </button>
                            <button class="w-full flex items-center justify-between text-left text-sm py-2 group">
                                <div class="flex items-center text-gray-700 group-hover:text-blue-600 transition-colors">
                                    <svg class="w-5 h-5 text-gray-400 mr-3 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    Atur Jadwal Praktek
                                </div>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Logout Button -->
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-6">
                        <button onclick="window.location.href='<?= base_url('logout') ?>'"
                            class="w-full flex items-center p-4 hover:bg-red-50 transition-all">
                            <div class="w-9 h-9 bg-red-50 rounded-xl flex items-center justify-center mr-3 flex-shrink-0">
                                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                            </div>
                            <span class="flex-1 text-left font-semibold text-red-500 text-sm">Keluar dari Akun</span>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Mobile Bottom Nav -->
</div>
<?= $this->include('components/bottom_nav') ?>
<?= $this->endSection() ?>

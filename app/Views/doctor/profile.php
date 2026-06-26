<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div id="profile-screen" class="flex flex-col h-full w-full bg-[#f5f1ec] flex-1 relative">
            <div class="flex-1 overflow-auto pb-20">
                <div class="bg-[#003E7E] relative overflow-hidden px-6 pt-10 pb-16">

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

                    <div class="flex flex-col items-center">
                        <div class="w-24 h-24 bg-[#ffffff]/20 rounded-full flex items-center justify-center border-4 border-white pb-1  text-white font-bold text-3xl mb-4">
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
                <div class="px-6 -mt-8 space-y-4 relative z-10">
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-[16px] relative shadow-sm" role="alert">
                            <span class="block sm:inline font-medium"><?= session()->getFlashdata('success') ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-[16px] relative shadow-sm" role="alert">
                            <span class="block sm:inline font-medium"><?= session()->getFlashdata('error') ?></span>
                        </div>
                    <?php endif; ?>

                    <!-- Informasi Profesional -->
                    <div class="bg-[#ffffff] rounded-[24px] p-5 border border-[#d3cec6]">
                        <div class="flex items-center justify-between mb-4 border-b border-[#d3cec6] pb-2">
                            <h4 class="font-bold text-[#111111]">Informasi Profesional</h4>
                            <?php if ($doctor['is_verified']): ?>
                                <span class="bg-green-100 text-green-700 text-xs font-bold px-2 py-1 rounded-full flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Terverifikasi
                                </span>
                            <?php else: ?>
                                <span class="bg-orange-100 text-orange-700 text-xs font-bold px-2 py-1 rounded-full flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Menunggu Verifikasi
                                </span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-[#7b7b78] font-medium mb-1">Spesialisasi</p>
                                <p class="text-sm font-semibold text-[#111111]"><?= esc($doctor['specialization'] ?? '-') ?></p>
                            </div>
                            <div>
                                <p class="text-xs text-[#7b7b78] font-medium mb-1">Pengalaman</p>
                                <p class="text-sm font-semibold text-[#111111]"><?= esc($doctor['experience_years'] ?? '0') ?> Tahun</p>
                            </div>
                            <div>
                                <p class="text-xs text-[#7b7b78] font-medium mb-1">No. STR</p>
                                <p class="text-sm font-semibold text-[#111111]"><?= esc($doctor['str_number'] ?? '-') ?></p>
                            </div>
                            <div>
                                <p class="text-xs text-[#7b7b78] font-medium mb-1">No. SIP</p>
                                <p class="text-sm font-semibold text-[#111111]"><?= esc($doctor['sip_number'] ?? '-') ?></p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-xs text-[#7b7b78] font-medium mb-1">Tarif Konsultasi</p>
                                <p class="text-sm font-semibold text-[#003E7E]">Rp <?= number_format($doctor['consultation_fee'] ?? 0, 0, ',', '.') ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Kontak -->
                    <div class="bg-[#ffffff] rounded-[24px] p-5 border border-[#d3cec6]">
                        <h4 class="font-bold text-[#111111] mb-4 border-b border-[#d3cec6] pb-2">Informasi Kontak</h4>
                        <div class="space-y-3">
                            <div class="flex items-center text-sm">
                                <svg class="w-5 h-5 text-[#7b7b78] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <span class="text-gray-700"><?= esc(session()->get('phone') ?? '-') ?></span>
                            </div>
                            <div class="flex items-center text-sm">
                                <svg class="w-5 h-5 text-[#7b7b78] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <span class="text-gray-700"><?= esc(session()->get('email') ?? '-') ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Pengaturan -->
                    <div class="bg-[#ffffff] rounded-[24px] p-5 border border-[#d3cec6]">
                        <h4 class="font-bold text-[#111111] mb-4 border-b border-[#d3cec6] pb-2">Pengaturan</h4>
                        <div class="space-y-3">
                            <form action="<?= base_url('doctor/profile/toggle-status') ?>" method="POST" class="w-full">
                                <button type="submit" class="w-full flex items-center justify-between text-left text-sm py-2 group">
                                    <div class="flex items-center text-gray-700 group-hover:text-[#111111] transition-colors">
                                        <?php if ($doctor['status'] == 'online'): ?>
                                            <div class="w-5 h-5 rounded-full bg-green-500 mr-3 shadow-[0_0_8px_rgba(34,197,94,0.6)]"></div>
                                            <span class="font-medium">Status: Online</span>
                                        <?php else: ?>
                                            <div class="w-5 h-5 rounded-full bg-gray-400 mr-3 border-2 border-gray-200"></div>
                                            <span class="font-medium">Status: Offline</span>
                                        <?php endif; ?>
                                    </div>
                                    <span class="text-xs text-[#003E7E] font-bold bg-blue-50 px-3 py-1 rounded-full">Ubah</span>
                                </button>
                            </form>
                            
                            <button onclick="window.location.href='<?= base_url('doctor/schedules') ?>'" class="w-full flex items-center justify-between text-left text-sm py-2 group">
                                <div class="flex items-center text-gray-700 group-hover:text-[#111111] transition-colors">
                                    <svg class="w-5 h-5 text-[#7b7b78] mr-3 group-hover:text-[#111111]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    Atur Jadwal Praktek
                                </div>
                                <svg class="w-5 h-5 text-[#7b7b78]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </button>

                            <button class="w-full flex items-center justify-between text-left text-sm py-2 group">
                                <div class="flex items-center text-gray-700 group-hover:text-[#111111] transition-colors">
                                    <svg class="w-5 h-5 text-[#7b7b78] mr-3 group-hover:text-[#111111]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                    Ubah Kata Sandi
                                </div>
                                <svg class="w-5 h-5 text-[#7b7b78]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Logout Button -->
                    <div class="bg-[#ffffff] rounded-[24px] overflow-hidden mb-6 shadow-sm border border-red-100">
                        <button onclick="window.location.href='<?= base_url('logout') ?>'"
                            class="w-full flex items-center p-4 hover:bg-red-50 transition-all">
                            <div class="w-9 h-9 bg-red-100 rounded-[16px] flex items-center justify-center mr-3 flex-shrink-0">
                                <svg class="w-4 h-4 text-[#E53935]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                            </div>
                            <span class="flex-1 text-left font-bold text-[#E53935] text-sm">Keluar dari Akun</span>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Mobile Bottom Nav -->
</div>
<?= $this->include('components/bottom_nav') ?>
<?= $this->endSection() ?>
